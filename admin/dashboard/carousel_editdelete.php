<?php 
include('../../db/connection.php');

if(isset($_POST['update_image'])) {
    $id = $_POST['id'];
    $imgfile = $_FILES["postimage"]["name"];
    $extension = substr($imgfile, strlen($imgfile) - 4, strlen($imgfile));
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        $imgnewfile = $imgfile . $extension;
        move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);    
        $query=mysqli_query($conn,"UPDATE tb_slider 
                                      SET slider = '$imgnewfile'
                                    where id='$id'
                                    ");                      
    } 
}
header("location:carousel_manage.php");

if(isset($_POST['delete_image'])) {
    $query = "SELECT COUNT(id) AS cid 
              FROM tb_slider
              GROUP BY id ORDER BY COUNT(id) DESC LIMIT 1
              ";
    $result = mysqli_query($conn, $query);
     while($row = $result->fetch_assoc()) {
        if($row['id'] <= 1){
            echo "รูปนี้เป็นรูปสุดท้าย ไม่สามารถลบได้";
        } else {
        $id = $_POST['id'];
        $query = mysqli_query($conn,"DELETE from tb_slider
                                    where id='$id'
                              ");  
        }                                        
    }
}
header("location:carousel_manage.php");
?>