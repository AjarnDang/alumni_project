<?php 
session_start();
//error_reporting(0);
include('../db/connection.php');

if (!isset($_SESSION['username'])) {
	echo"<script>alert('ขออภัย กรุณาล็อคอินเพื่อเข้าสู่ระบบ')</script>";
    header("location: ../login-system/login_form.php");
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../assets/img/sci_logo.png" type="image/png">
    <title>ศิษย์เก่าคณะวิทยาศาสตร์ มหาวิทยาลัยขอนแก่น</title>
    <script src="https://kit.fontawesome.com/0f35e6e1c5.js" crossorigin="anonymous"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>   
	<link href="../assets/css/header.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element){
              element.addEventListener('click', function (e) {
                e.stopPropagation();
              });
            })
        }); 
    </script>
</head>
<body>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>	
<header class="contact-header">
<div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
        <ul class="list-group list-group-horizontal">
          <li class="pr-4">
            <a class="social-md" href="donate.php" class="pr-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>
            <span class="text">บริจาคให้เรา</span> 
			</a>
          </li>
          <li class="pr-4">
            <a class="social-md" href="contact.php" class="pr-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg> 
            <span class="text">ติดต่อเรา</span>
			</a>
          </li>
		  <li class="pr-4"><a class="social-md" target="_blank" href="https://www.facebook.com/Faculty-of-Science-Khon-Kaen-University-173153522752360/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg>
		  	<span class="text">เฟสบุ้ก</span>			
			</a></li>
          <li class="pr-4"><a class="social-md" target="_blank" href="https://sc.kku.ac.th/sciweb/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16"><path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/></svg>
		  	<span class="text">เว็บไซต์คณะ</span>
			</a></li>
		  <li class="pr-4">
		  	<?php
				//current URL of the Page. cart_update.php redirects back to this URL
				$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
				if(isset($_SESSION["cart_session"])) { 	
					$total = 0; 
					foreach ($_SESSION["cart_session"] as $cart_itm) {
						$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
						$total = ($total + $subtotal); } ?>

							<div class="icon-badge-group">
								<a class="social-md" href="view_cart.php">
								<div class="icon-badge-container">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
									<div class="icon-badge">
										<?php //echo $cart_itm["qty"] ?>
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation" viewBox="0 0 16 16">
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>
</svg>
									</div>
								</div>
								<span class="text"> ตะกร้าสินค้า</span>	
								</a>
							</div>	
						<?php
				}else{ ?>
					<div class="icon-badge-group">
						<a class="social-md" href="view_cart.php">
							<div class="icon-badge-container">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
							</div>
						<span class="text"> ตะกร้าสินค้า</span>	
						</a>
					</div>
				<?php } ?>
				 
		  </li>
        </ul>
      </div>
      
  </header>

<nav class="navbar navbar-expand-lg navbar-light navigation-bar">
<div class="container">
	<a class="navbar-brand" href="user_home.php"><img src="../assets/img/sci_logo.png" alt="sci-logo"></a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle

				" href="#" data-bs-toggle="dropdown">
					เกี่ยวกับเรา
				</a>
				<div class="dropdown-menu dropdown-large">
					<div class="row g-3">
						<div class="col-6">
						<!--<h4>เกี่ยวกับเรา</h4>-->
							<ul class="list-unstyled">
								<li class="text-left"><a href="#">ประวัติสมาคม</a></li>
								<li class="text-left"><a href="#">ข้อบังคับสมาคม</a></li>
								<li class="text-left"><a href="#">ทำเนียบสมาคม</a></li>
								<li class="text-left"><a href="#">คณะกรรมการ</a></li>
							</ul>
						</div>
						<div class="col-6">
						<!--<h4>ทุนการศึกษา</h4>-->
							<ul class="list-unstyled">
								<li class="text-left"><a href="#">ทุนการศึกษาประเภท ก.</a></li>
								<li class="text-left"><a href="#">ทุนการศึกษาประเภท ข.</a></li>
								<li class="text-left"><a href="#">ทุนวิจัย</a></li>
								<li class="text-left"><a href="#">ทุนเรียนดี</a></li>
							</ul>
						</div>
					</div>

					<div class="row g-3 mt-3">
						<div class="col-6">
						<!--<h4>เรียนต่อกับเรา</h4>-->
							<ul class="list-unstyled">
								<li class="text-left"><a href="#">หลักสูตรปริญญาโท</a></li>
								<li class="text-left"><a href="#">หลักสูตรปริญญาเอก</a></li>
							</ul>
						</div>
					</div>
		
				</div> <!-- dropdown-large.// -->
			</li> 
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle
					<?= ($activePage == 'hall_of_fame') ? 'active' : ''; ?>
					<?= ($activePage == 'hall_of_fame_detail') ? 'active' : ''; ?>
					<?= ($activePage == 'alumni_network') ? 'active' : ''; ?>
					<?= ($activePage == 'alumni') ? 'active' : ''; ?>
					<?= ($activePage == 'alumni_detail') ? 'active' : ''; ?>
				" href="#" data-bs-toggle="dropdown">
					ศิษย์เก่า
				</a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="hall_of_fame.php">Hall of Fame (หอเกียรติยศ)</a></li>
				  <li><a class="dropdown-item" target="_blank" href="https://www.facebook.com/AlumniRelationsKKU/">สมาคมศิษย์เก่า มหาวิทยาลัยขอนแก่น</a></li>
				  <!--<li><a class="dropdown-item" href="alumni_network.php">เครือข่ายศิษย์เก่า</a></li>-->
				  <li><a class="dropdown-item" href="alumni_import.php">รายชื่อศิษย์เก่า</a></li>
			    </ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle
					<?= ($activePage == 'news_ac') ? 'active' : ''; ?>
					<?= ($activePage == 'news_ac_detail') ? 'active' : ''; ?>
					<?= ($activePage == 'news_ac_category') ? 'active' : ''; ?>
					<?= ($activePage == 'activity') ? 'active' : ''; ?>
					<?= ($activePage == 'activity_detail') ? 'active' : ''; ?>
					<?= ($activePage == 'activity_category') ? 'active' : ''; ?>
				" href="#" data-bs-toggle="dropdown">
					กิจกรรมและข่าวสาร
				</a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="news_ac.php">ข่าวสาร</a></li>
				  <li><a class="dropdown-item" href="activity.php">กิจกรรมสัมพันธ์</a></li>
				   
			    </ul>
			</li>
			<li class="nav-item">
				<a class="nav-link 
					<?= ($activePage == 'community') ? 'active' : ''; ?>
					<?= ($activePage == 'community_detail') ? 'active' : ''; ?>
					<?= ($activePage == 'community_category') ? 'active' : ''; ?>
					" href="community.php">คอมมูนิตี้</a></li>
			<li class="nav-item">
				<a class="nav-link 
					<?= ($activePage == 'store') ? 'active' : ''; ?>
					<?= ($activePage == 'product') ? 'active' : ''; ?>
					" href="store.php">
					สินค้าที่ระลึก</a>
				</li>
		</ul>
		<ul class="navbar-nav ms-auto">
			<li class="nav-item dropdown">
				<a class="nav-link btn dropdown-toggle" href="#" data-bs-toggle="dropdown">
					<?php echo $_SESSION['username']; ?>
				</a>			
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="user_order.php">การสั่งซื้อสินค้า</a></li>
					<!--<li><a class="dropdown-item" href="donate_status.php">การบริจาคสิ่งของ</a></li>-->
					<li><a class="dropdown-item" href="user_profile.php">บัญชีของฉัน</a></li>
					<li><a class="dropdown-item" href="user_history.php">ประวัติการเปลี่ยนแปลงข้อมูล</a></li>
					<li><a class="dropdown-item" href="../login-system/logout.php">ออกจากระบบ</a></li>
				</ul>		
			</li>
		</ul>
	</div> <!-- navbar-collapse.// -->
</div> <!-- container-fluid.// -->
</nav>
</body>