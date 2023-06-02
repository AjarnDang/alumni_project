<?php
	include('../../db/connection.php');
	
	$Product_ID=$_GET['Product_ID'];
	$stock_old=$_POST['stock_old'];
	$stock=$_POST['stock'];
	$bal = $stock_old + $stock;
	
	
		mysqli_query($conn,"UPDATE store set stock = '$bal' WHERE Product_ID=		'$Product_ID'");
			
	header('location:./product_dashboard.php');
