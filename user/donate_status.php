<?php
require('../template/header_user.php');
require_once("../template/pagination_function.php");
?>
<style>
  body {background-color: #f5f5f5 !important;}
  .form-2 {background-color: white; padding: 2em; border-radius: 0.7em; box-shadow: 2px 5px 5px rgba(0, 0, 0, 0.1);}
</style>
<link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="../assets/css/header.css">
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
<div class="container mt-5">
  <div class="bread-crump mb-3">
      <a href="user_home.php">หน้าหลัก</a> >
      <a href="#">การสั่งซื้อสินค้า</a> 
    </div>
<div class="form-2">
    <div class="d-flex justify-content-between">
        <div><h3 class="mb-4">การสั่งซื้อสินค้า</h1></div>
        
      </div>
      <?php
      	$count = 1;
				$perpage = 8;
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
				} else {
					$page = 1;
				}
				
				$start = ($page - 1) * $perpage;
        $Email = $_SESSION['email'];
       
        $sql = "SELECT * FROM donates_status WHERE email='$Email' 
                        ORDER BY update_time 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
        $query2 = mysqli_query($conn, $sql);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
				while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <hr class="mb-4">
              <!--<th class="text-center" scope="row"><//?=($step_num*$e_page)+$num?></th>-->
              <p style="text-align:left;"><?php echo "<code>สถานะ : </code>" . $row['statuss'];?></p>
              <p style="text-align:left;"><?php echo "<code>วันที่ (เวลา) : </code>" . $row['update_time']; ?></p>
              <p class="text-left" ><?=$row['update_data']?></p>
  <?php 
            } ?>
            
            <div style="height: 1em;"></div>
      <?php page_navi($total_page,(isset($_GET['page']))?$_GET['page']:1,$perpage);?>
    </div>
  </div>
 
     
 
  </body>
  <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
  <?php require('../template/footer_users.php') ?>
     