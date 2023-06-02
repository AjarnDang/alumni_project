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
			<a href="#">คอมมูนิตี้</a> >
			<a href="#">ภาพรวมระบบ</a> 
		</div>
		<div class="pt-2 header-product">
			<strong>ภาพรวมระบบคอมมูนิตี้</strong>
		</div>	

		<hr>

		<div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="news_category_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-th-list"></i>
                                    </div>
									
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <div class="stat-heading">หัวข้อ/โพสต์ ทั้งหมด</div>
										
										<?php $query=mysqli_query($conn,"SELECT * from community_topic where Is_Active=1");
					 					$countcat=mysqli_num_rows($query);	?>

                                            <div class="stat-text"><span><?php echo htmlentities($countcat);?></span></div>                                     
                                        </div>
                                    </div>
									
                                </div>
                            </div>
                        </div>
						</a>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="./news_subcategory_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">หมวดหมู่</div>

											<?php $query=mysqli_query($conn,"SELECT * from community_category where Is_Active=1");
											$countsubcat=mysqli_num_rows($query); ?>

                                            <div class="stat-text"><span><?php echo htmlentities($countsubcat);?></span></div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</a>
                    </div> 
                    
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<a href="news_category_manage.php">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-browser"></i>
                                    </div>						
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                        <div class="stat-heading">ผู้ใช้งานที่โพสต์เยอะที่สุด</div>
										                             
										<?php 
                                        $sql = "SELECT community_topic.user_id, COUNT(user_id) cnumber, 
                                                       user.firstname,
                                                       user.lastname
                                                FROM community_topic 
                                                JOIN user on user.id = community_topic.user_id
                                                GROUP BY user_id ORDER BY COUNT(user_id) DESC LIMIT 1";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_array($result)) { 
                                        ?>

                                            <div class="stat-text">
                                                <span>
                                                    <?php echo($row['firstname']." ".$row['lastname']);?><br>
                                                    <?php echo($row['cnumber']) ?> โพสต์
                                                </span>
                                            </div>   
                                        <?php } ?>                                  
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