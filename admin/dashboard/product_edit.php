<?php
	include('../../db/connection.php');
	
	$Product_ID=$_GET['Product_ID'];
	$productName=$_POST['productName'];
	$Description=$_POST['Description'];
	$Price=$_POST['Price'];
	$stock=$_POST['stock'];
	
	$file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
	if($file != ""){
		$new_image = 'Picture'. uniqid(). "." . $file;
		$image_path = "postimages/";
		$upload_path = $image_path . "/" . $new_image;

		$upload = move_uploaded_file($_FILES['Picture']['tmp_name'], $upload_path);
		if ($upload == FALSE){
			echo "ไม่สามารถอัพโหลดได้";
			exit();
		}
		$pro_image = $new_image;
		$pic = "/" . $pro_image;
		
		mysqli_query($conn,"UPDATE store set 
									productName=		'$productName',
									Description=		'$Description',
									Price=				'$Price',
									Picture =			'$pic',
									stock =				'$stock'
							  WHERE Product_ID=			'$Product_ID'
							  ");
		} else {
		mysqli_query($conn,"UPDATE store set 
									productName=	'$productName',
									Description=	'$Description',
									Price=			'$Price',
									stock =			'$stock'
							  WHERE Product_ID=		'$Product_ID'
							  ");
			}
	header('location:./product_dashboard.php');
