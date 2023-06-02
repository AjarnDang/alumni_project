<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";
require "./PHPMailer/src/Exception.php";

include('../db/connection.php');
if(isset($_POST['submit'])) {
    $posttitle=         $_POST['posttitle'];
    $catid=             $_POST['category'];
    $postdetails=       $_POST['postdescription'];
    $arr =              explode(" ",$posttitle);
    $url=               implode("-",$arr);
    $user_id=           $_POST['user_id'];
    $email =            $_POST['email'];
    $name=              $_POST['name'];
    $message=           $_POST['message'];

    $imgfile=$_FILES["postimage"]["name"];

   // get the image extension
    if(!empty($imgfile)) {
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
    if(!in_array($extension,$allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {           
        $imgnewfile=md5($imgfile).$extension;
        move_uploaded_file($_FILES["postimage"]["tmp_name"],"../admin/dashboard/postimages/".$imgnewfile);
            $query=mysqli_query($conn,"INSERT into community_topic(PostTitle,
                                                                CategoryId,                                                                 
                                                                PostDetails,
                                                                PostUrl,
                                                                Is_Active,
                                                                PostImage,
                                                                user_id
                                                                )
                                                            values('$posttitle',
                                                                '$catid',
                                                                '$postdetails',
                                                                '$url',
                                                                1,
                                                                '$imgnewfile',
                                                                '$user_id'
                                                                )");                                                                                                           
            if($query) {             
                //Create an instance; passing true enables exceptions
                $mail = new PHPMailer(true);
                try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;      
                $mail->CharSet    = "utf-8";                             //Enable SMTP authentication
                $mail->Username   = 'admin@scialumnikku.com';                     //SMTP username
                $mail->Password   = '0812601030Aa@';                               //SMTP password
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

                //Recipients
                $mail->setFrom('admin@scialumnikku.com', 'Admin Alumni - SCI KKU');
                $mail->addAddress('torntan.j@gmail.com');     //Add a recipient

                //Content
                //Set email format to HTML
                $mail->Subject = "มีผู้ใช้งานเพิ่มโพสต์ใหม่ในคอมมูนิตี้";
                $mail->Body    = "<h4>คุณมีโพสต์ใหม่จากผู้ใช้งาน $name</h4>
                                    <div style='padding: 1.5em; border:1px solid black; border-radius:5px;'>
                                        <h2>$posttitle</h2>
                                        $postdetails
                                    </div>
                                 ";
                $mail->isHTML(true);

                $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } 
        }
    } else {
        $query=mysqli_query($conn,"INSERT into community_topic(PostTitle,
                                                                CategoryId,                                                                 
                                                                PostDetails,
                                                                PostUrl,
                                                                Is_Active,
                                                                user_id
                                                                )
                                                            values('$posttitle',
                                                                '$catid',
                                                                '$postdetails',
                                                                '$url',
                                                                1,
                                                                '$user_id'
                                                                )");                                                                                                           
            if($query) {
                //Create an instance; passing true enables exceptions
                $mail = new PHPMailer(true);

                try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;    
                $mail->CharSet    = "utf-8";                               //Enable SMTP authentication
                $mail->Username   = 'admin@scialumnikku.com';                     //SMTP username
                $mail->Password   = '0812601030Aa@';                               //SMTP password
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

                //Recipients
                $mail->setFrom('admin@scialumnikku.com', 'Admin Alumni - SCI KKU');
                $mail->addAddress('torntan.j@gmail.com');     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "มีผู้ใช้งานเพิ่มโพสต์ใหม่ในคอมมูนิตี้";
                $mail->Body    = "<h4>คุณมีโพสต์ใหม่จากผู้ใช้งาน $name</h4>
                                    <div style='padding: 1.5em; border:1px solid black; border-radius:5px;'>
                                        <h2>$posttitle</h2>
                                        $postdetails
                                    </div>
                                 ";

                $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }    
            }
        }
        header('location:community_addpost.php');
    }
?>

