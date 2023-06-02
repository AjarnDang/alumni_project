<?php  
  include('header_dashboard.php'); 
  require_once('../../template/pagination_function.php');
?>
<link href="assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />		
<link rel="stylesheet" href="../../assets/css/news_ac_dashboard.css">
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>
	<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">ศิษย์เก่าดีเด่น</a> >
			<a href="product_dashboard.php">ภาพรวมระบบ</a> 
		</div>
		<div class="pt-2 header-product">
			<strong>ภาพรวมระบบศิษย์เก่าดีเด่น</strong>
		</div>	

		<hr>

		<div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="hof_dashboard.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-th-list"></i>
                                    </div>
									
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <div class="stat-heading">ศิษย์เก่าดีเด่นในปีนี้</div>
										<?php 
                                        $year = date("Y") + 543;
                                        $query=mysqli_query($conn,"SELECT * FROM hall_of_fame WHERE hof_year = $year");
                                            $rowcount = mysqli_num_rows($query);	
                                        ?>

                                            <div class="stat-text"><span class="count"><?php echo htmlentities($rowcount);?></span> คน</div>                                     
                                        </div>
                                    </div>
									
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="hof_dashboard.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">รางวัลที่ได้รับทั้งหมด</div>
											<?php 
                                            ?>

                                            <div class="stat-text"><span class="count"></span> รางวัล</div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</a>
                    </div>					
                </div>


	</div>

<?php include('DashboardScript.php') ?>
</body>
</html>