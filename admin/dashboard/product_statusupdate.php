<?php
	include('../../db/connection.php');
	
    $order_id       =$_GET['order_id'];
	$username       =$_POST['username'];
    $email          =$_POST['email'];
    $tel            =$_POST['tel'];
    $addresss       =$_POST['addresss'];
    $code           =$_POST['code'];
    $productName    =$_POST['productName'];
    $quantity       =$_POST['quantity'];
    $totalprice     =$_POST['totalprice'];
    $price          =$_POST['price'];
    $statuss         =$_POST['statuss'];
	$tacking        =$_POST['tacking'];
	
	/*$file = pathinfo(basename($_FILES['Picture']['name']), PATHINFO_EXTENSION);
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
		
		mysqli_query($conn,$sql="UPDATE orders set 
									username   =	'$username',
									email =		    '$email',
									tel=				'$tel',
									addresss =			'$addresss',
									Picture =				'$pic',
                                    productName =           '$productName',
                                    totalprice  =           '$totalprice',
                                    code        =           '$code',
                                    quantity    =           '$quantity',
                                    price       =           '$price',
                                    statuss      =           '$statuss',
									tacking		=			'$tacking'
							  WHERE order_id=			'$order_id'
							  ");
		} else {*/
		/*mysqli_query($conn,$sql="UPDATE orders set 
									username=		'$username',
									email=		'$email',
									tel=				'$tel',
									addresss =			'$addresss',
									Picture =				'$pic',
                                    productName =           '$productName',
                                    totalprice  =           '$totalprice',
                                    code        =           '$code',
                                    quantity    =           '$quantity',
                                    price       =           '$price',
                                    statuss      =           '$statuss',
									tacking		=			'$tacking'
                                    WHERE order_id=			'$order_id'
							  ");*/
		//}
		$dateNow = date("Y-m-d H:i");
		mysqli_query($conn,$sql="UPDATE orders set 
									update_at=		'$dateNow',
									statuss      =           '$statuss',
									tacking		=			'$tacking'
                                    WHERE order_id=			'$order_id'
							  ");
							  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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
																			  tacking,
                                                                              update_data
																			   ) 
																	    VALUES ('$email',
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
																				'$tacking',
                                                                                '$dataup'
																			   )";
								  $resultUp = mysqli_query($conn, $sqlupdateorder);
								  header('location:./product_formorder.php');    
								   exit();   
							  
			}
	
	?>
