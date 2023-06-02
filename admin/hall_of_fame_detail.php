<?php 
require('../template/header_admin.php');
?>
<link rel="stylesheet" href="../assets/css/css-carousel-14/owl.carousel.min.css">
<link rel="stylesheet" href="../assets/css/css-carousel-14/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/hall_of_fame_detail.css">
<script src="../assets/js/hall_of_fame_detail.js"></script>


<link rel="stylesheet" href="../assets/css/css-carousel-9/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/css/css-carousel-9/owl.theme.default.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
	<link rel="stylesheet" href="../assets/css/css-carousel-9/style.css">
<?php
$id = $_GET['id'];
$sql =  "SELECT hall_of_fame.id                  as id,
                hall_of_fame.hof_prefix          as hof_prefix,
                hall_of_fame.hof_firstname       as hof_firstname,
                hall_of_fame.hof_lastname        as hof_lastname,
                hall_of_fame.hof_position        as hof_position,
                hall_of_fame.hof_description     as hof_description,
                hall_of_fame.hof_date_of_birth   as hof_date_of_birth,
                hall_of_fame.hof_history         as hof_history,
                hall_of_fame.hof_image           as hof_image,
                hall_of_fame.hof_image_2         as hof_image_2,
                hall_of_fame.hof_image_cover     as hof_image_cover,
                hall_of_fame.hof_year            as hof_year,
                hall_of_fame.Is_Active           as Is_Active,
                hall_of_fame_mastery.hof_id      as hof_m_id,
                hall_of_fame_mastery.mastery     as mastery,
                hall_of_fame_reward.hof_id       as hof_r_id,
                hall_of_fame_reward.reward       as reward
           FROM hall_of_fame 
           JOIN hall_of_fame_mastery on hall_of_fame_mastery.hof_id = hall_of_fame.id
           JOIN hall_of_fame_reward  on hall_of_fame_reward.hof_id  = hall_of_fame.id
          WHERE hall_of_fame.id = $id
            ";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
 /*
    $startDate = $row['hof_date_of_birth'];  
    $startdateFormat = date('d M Y', strtotime($startDate));
    $newDate = date("d", strtotime($startDate));  
    $newMonth = date("n", strtotime($startDate));
    $newYear = date("Y", strtotime($startDate));

    $NewDate = $row['hof_year'];  
    $NewdateFormat = date('d M Y', strtotime($NewDate));*/
?>
<body>
    <figure class="grad1">
        <?php
            $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $row = mysqli_fetch_array($result);
            if($row['hof_image_cover'] != "") {
                echo "<img class='image-cover' src='".$row['hof_image_cover']."'>";
            } else {
                echo "<img class='image-cover' src='../assets/img/decoration-img/kku-darker.jpg'>";
            }          
        ?>
        <div class="bread-crump-bg">
            <div class="container">
                <div class="bread-crump mt-4">
                    <a href="user_page.php">หน้าหลัก</a> >
                    <a href="hall_of_fame.php">Hall of Fame (หอเกียรติยศ)</a> >
                    <a href="#"><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <figcaption>
            <?php
            if($row['hof_image'] != "") {
                echo "<img src='".$row['hof_image']."'>";
                } else {
                echo "<img src='https://www.pngitem.com/pimgs/m/391-3918613_personal-service-platform-person-icon-circle-png-transparent.png'>";
            }      
            ?>
                <h1 class="mt-3"><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></h1>
            </figcaption>
        </div>
    </figure> 

    <div class="container pb-5">
        <div class="hof-des">
            <div class="row box">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <ul>
                        <li><h5>ศิษย์เก่าดีเด่นประจำปี</h5></li>
                        <li><?php echo $row['hof_year']; ?></li>
                    </ul>
                    
                    <ul>
                        <li><h5>วัน/เดือน/ปี เกิด</h5></li>
                        <li><?php //echo date($newDate)." ".$month_arr[date($newMonth)]." ".(date($newYear)+543);?>
                            -
                        </li>
                    </ul>
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <ul>
                        <li><h5>ความถนัด</h5></li>
                        <?php 
                        $sql = "SELECT hall_of_fame.id              as id,
                                       hall_of_fame_mastery.hof_id  as hof_id,
                                       hall_of_fame_mastery.mastery as mastery
                                  FROM hall_of_fame
                                  JOIN hall_of_fame_mastery on hall_of_fame_mastery.hof_id = hall_of_fame.id
                                  WHERE hall_of_fame.id = $id
                                ";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) { 
                        ?>
                            <li><?php echo $row['mastery']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php 
        $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        ?>
        <div class="col-12 pt-4 mt-5 p-0">
            <p style="font-size: 18px; font-weight:300;">
                <?php echo $row['hof_description']; ?>
            </p>
        </div>
    </div>
    <?php 
    
    $query = "SELECT hall_of_fame.id              as id,
                     hall_of_fame_reward.slider   as slider,
                     hall_of_fame_reward.hof_id   as hof_id,
                     hall_of_fame_reward.reward   as reward
                FROM hall_of_fame
                JOIN hall_of_fame_reward on hall_of_fame_reward.hof_id = hall_of_fame.id
               WHERE hall_of_fame.id = $id 
              ";
    $result = mysqli_query($conn, $query);
    ?>
    <div class="col-md-12 col-xs-12 p-0">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php
              $i=0;
              foreach($result as $row){
              $actives='';
              if($i==0){
              $actives='active';
              }
              ?>
              <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo $actives;?> ">
                
              </li>
              <?php $i++;} ?>
            </ol>
            <div class="carousel-inner">
              <?php
              $i=0;
              foreach($result as $row){
              $actives='';
              if($i==0){
              $actives='active';
              }
              ?>
              <div class="carousel-item <?php echo $actives;?>">
                <a href="https://www.youtube.com/c/devbanban" target="_blank">
                  <img class="d-block w-100" src="../assets/img/decoration-img/<?php echo $row['slider'];?>" alt="devbanban">
                  <div class="carousel-caption d-md-block text-center w-50 m-auto">
                    <p>รางวัลที่เคยได้รับ</p>
                    <h5 class="w-100"><?php echo $row['reward'];?></h5>                 
                  </div>
                </a>
              </div>
              <?php 
              $i++;}
              ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div> 

    <div class="container">
        <?php 
        $sql = "SELECT * FROM hall_of_fame WHERE id = $id";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        ?>
        <div class="hof-history">
            <h2>ประวัติ</h2>  
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p><?php echo $row['hof_history'] ?></p>
                </div>
            </div>
        </div>

        <hr>
        
        <div class="hof_rand">
        <h2>ศิษย์เก่าดีเด่น</h2>  
        <div class="row">
        <?php
        $sql = "SELECT * FROM hall_of_fame ORDER BY RAND() LIMIT 8";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>

        <div class="col-lg-3 col-sm-6 col-xs-6 pt-4">
            <div class="ymal">
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['hof_image'] ?>" alt="">
                </a>
                <a href="hall_of_fame_detail.php?id=<?php echo $row['id']; ?>">
                    <div class="alumni-name text-center mt-3">
                        <h5><?php echo $row['hof_prefix']." ".$row['hof_firstname']." ".$row['hof_lastname']; ?></h5>
                        <p><?php echo $row['hof_position'] ?></p>
                    </div>
                </a>
            </div>
        </div> 

        <?php } ?> 
        </div>   
        </div>
    </div>

    <script src="../assets/js/js-carousel-9/jquery.min.js"></script>
    <script src="../assets/js/js-carousel-9/popper.js"></script>
    <script src="../assets/js/js-carousel-9/bootstrap.min.js"></script>
    <script src="../assets/js/js-carousel-9/owl.carousel.min.js"></script>
    <script src="../assets/js/js-carousel-9/main.js"></script>

    <script src="../assets/js/js-carousel-14/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/js-carousel-14/popper.min.js"></script>
    <script src="../assets/js/js-carousel-14/bootstrap.min.js"></script>
    <script src="../assets/js/js-carousel-14/owl.carousel.min.js"></script>
    <script src="../assets/js/js-carousel-14/main.js"></script>
</body>

<?php require('../template/footer_users.php'); ?>