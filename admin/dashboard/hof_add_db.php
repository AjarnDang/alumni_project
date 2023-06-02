<?php
$conn = mysqli_connect("localhost", "root", "", "alumni_sci");


$hof_prefix         =$_POST['hof_prefix'];
$hof_firstname      =$_POST['hof_firstname'];
$hof_lastname       =$_POST['hof_lastname'];
$hof_position       =$_POST['hof_position'];
$hof_date_of_birth  =date('Y-m-d', strtotime($_POST['hof_date_of_birth']));
$hof_description    =$_POST['hof_description'];
$hof_history        =$_POST['hof_history'];
$mastery 			=count($_POST["mastery"]);
$reward 			=count($_POST["reward"]);
$hof_year           =$_POST["hof_year"];
$hof_image          =$_POST["hof_image"];
/*
$imgfile            =$_FILES["hof_image"]["name"];
$extension   = substr($imgfile,  strlen($imgfile)  -4,strlen($imgfile));

$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions)) {
    echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
} else {
    $imgnewfile=md5($imgfile).$extension;
    move_uploaded_file($_FILES["hof_image"]["tmp_name"],"postimages/".$imgnewfile);
    */
    $query="INSERT into hall_of_fame(hof_prefix,
                                     hof_firstname,
                                     hof_lastname,
                                     hof_position,
                                     hof_date_of_birth,
                                     hof_description,
                                     hof_history,
                                     hof_year,
                                     hof_image,
                                     Is_Active
                                    )
                             values('$hof_prefix',
                                    '$hof_firstname',
                                    '$hof_lastname',
                                    '$hof_position',
                                    '$hof_date_of_birth',
                                    '$hof_description',
                                    '$hof_history',
                                    '$hof_year',
                                    '$hof_image',
                                    1
                                    )";
    mysqli_query($conn, $query);                                
    $last_id = $conn->insert_id; 
    
    if($reward >= 1) {
        for($i=0; $i<$reward; $i++) {
            if(trim($_POST["reward"][$i] != '')) {
                $sql = "INSERT INTO hall_of_fame_reward(reward,
                                                        slider,
                                                         hof_id
                                                         ) 
                        VALUES ('".mysqli_real_escape_string($conn, $_POST["reward"][$i])."',
                                                        'kku-2-darker.jpg',
                                                        $last_id
                                )
                        ";
                mysqli_query($conn, $sql);
            }
        }
        //echo "Data Inserted";
    }
    if($mastery >= 1) {
        for($p=0; $p<$mastery; $p++) {
            if(trim($_POST["mastery"][$p] != '')) {
                $sql2 = "INSERT INTO hall_of_fame_mastery(mastery,
                                                         hof_id
                                                         ) 
                         VALUES ('".mysqli_real_escape_string($conn, $_POST["mastery"][$p])."',
                                                        $last_id
                                )
                        ";
                mysqli_query($conn, $sql2);
            }
        }
       //echo "Data Inserted";
     
    }

    if($query) {
        echo "Data Inserted";
    } else {
        echo "Error";
    }
    ?>