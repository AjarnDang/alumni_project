<?php
include('../db/connection.php');
if(isset($_POST['save'])) {
    $username       =$_POST['username'];
    $email          =$_POST['email'];
    $tel            =$_POST['tel'];
    $addresss       =$_POST['addresss'];
    $code           =$_POST['code'];
    $productName    =$_POST['productName'];
    $quantity       =$_POST['quantity'];
    $totalprice     =$_POST['totalprice'];
    $price          =$_POST['price'];
    $statuss        =$_POST['statuss'];

$file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
if($file != ""){
    $new_image = 'Picture'. uniqid(). "." . $file;
    $image_path = "";
    $upload_path = $image_path . "../admin/dashboard/postimages/" . $new_image;
    $upload = move_uploaded_file($_FILES['Picture']['tmp_name'], $upload_path);
    if ($upload == FALSE){
        echo "ไม่สามารถอัพโหลดได้";
        exit();
    }
    $pro_image = $new_image;
    $pic = "" . $pro_image;
    } else {
        $pic = "./postimages"; 
    }

    $sql="INSERT INTO orders(username,
                             email,
                             tel,
                             addresss,
                             Picture,
                             totalprice,
                             code,
                             statuss
                            ) 
                   VALUES ('$username',
                           '$email',
                           '$tel',
                           '$addresss',
                           '$pic',
                           '$totalprice',
                           '$code',
                           '$statuss'
                            )";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $last_id = $conn->insert_id;
    foreach( $productName as $key => $pn ) {
        if ($pn != "") {
            $qu = $quantity[$key];
            $pr = $price[$key];
            $sql_det="INSERT INTO orders_detail(orders_id,
                             productName,
                             quantity,
                             price
                            ) 
                   VALUES ('$last_id',
                           '$pn',
                           '$qu',
                           '$pr'
                            )";
    mysqli_query($conn, $sql_det) or die(mysqli_error($conn));

    $sql_check = "select * from store where productName = '".$pn."' ";
	$res = mysqli_query($conn,$sql_check);
	
	while($row = mysqli_fetch_array($res)) {
		$data['Product_ID'] = $row['Product_ID'];
		$data['stock'] = $row['stock'];

	}

    $bal = $data['stock'] - $qu;
    mysqli_query($conn,"UPDATE store SET stock='".$bal."' WHERE Product_ID = '".$data['Product_ID'] ."'");

        }
    }


    


    if ($result) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ');</script>";
        $date = date("Y-m-d");
        $sql2 = "SELECT * FROM orders";
        
        $dataup = $username.",".
                  $email.",".
                  $tel.",".
                  $addresss.",".
                  $code;
                  
                  $sqlupdateorder = "INSERT INTO order_update(email,
                                                             username,
                                                             tel,
                                                             addresss,
                                                             code,
                                                             productName,
                                                             price,
                                                             totalprice,
                                                             quantity,
                                                             statuss,
                                                             update_at,
                                                             update_data
                                                            ) 
                                                    VALUES('$email',
                                                           '$username',
                                                           '$tel',
                                                           '$addresss',
                                                           '$code',
                                                           '$productName',
                                                           '$price',
                                                           '$totalprice',
                                                           '$quantity',
                                                           '$statuss',
                                                           '$date',
                                                           '$dataup'
                                                            )";
        $resultUp = mysqli_query($conn, $sqlupdateorder);
        session_start();    
         unset($_SESSION["cart_session"]);     
         header("location:form_order_submit.php");      
         exit();   
    } else {
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
        
    }         
}
?>