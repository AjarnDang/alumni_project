<?php 
	include('header_dashboard.php');
	error_reporting(0);
	if(strlen($_SESSION['username'])=='admin') { 
		header('location:../../login-system/login_form.php');
	} else {
		if($_GET['action']=='del' && $_GET['rid']) {
			$id=intval($_GET['rid']);
			$query=mysqli_query($conn,"UPDATE orders set staytus='0' where order_id='$id'");
			$msg="ยืนยันออเดอร์";
		}
		//restore
		if($_GET['resid']) {
			$id=intval($_GET['resid']);
			$query=mysqli_query($conn,"UPDATE orders set staytus='1' where order_id='$id'");
      $msg="กู้คืน";
		}
		
		//Forever delete
		if($_GET['action']=='parmdel' && $_GET['rid']) {
			$id=intval($_GET['rid']);
			$query=mysqli_query($conn,"DELETE from orders where order_id='$id'");
			$delmsg="ยืนยันการลบ";
		}
    if($_GET['action']=='cen' && $_GET['rid']) {
			$id=intval($_GET['rid']);
			$query=mysqli_query($conn,"UPDATE orders set staytus='2' where order_id='$id'");
			$msg="ยืนยันออเดอร์";
		}
    }
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">จัดการสินค้าที่ระลึก</a> >
			<a href="product_formorder.php">รายการสั่งซื้อ</a> 
		</div>
        <div class="row mt-4">
      <div class="col-md-12">
        <h5 style="font-size: 20px;" class="mb-2"></i>
          ประวัติและคำสั่งซื้อที่ยกเลิกแล้ว
        </h5>

        <div class="table-responsive">
          <table class="table m-0 table-bordered-danger">
            <thead>
              <tr>
                
                <th>สินค้า</th>
                <th>ราคารวม</th>
                <th>ชื่อผู้รับ</th>
                <th>อีเมล</th>
                <th>เบอร์</th>
                <th>ที่อยู่จัดส่ง</th>
                <th>รหัสไปรษณีย์</th>
                <th>หมายเหตุ</th>
              </tr>
            </thead>

            <tbody>
            <?php
				$count = 1;
				$perpage = 8;
				if (isset($_GET['page'])) {
				$page = $_GET['page'];
				} else {
					$page = 1;
				}
				
				$start = ($page - 1) * $perpage;
				
				$sql = "SELECT * from orders  WHERE staytus=2
                        ORDER BY created_at 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>


                <tr>
                  
                  <td><?php echo $row['productName'];?></td>
                  <td><?php echo '<span>'.$currency.'</span>'?><?php echo $row['totalprice']; ?></td>     
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['tel'];?></td>
                  <td><?php echo $row['addresss'];?></td>
                  <td><?php echo $row['code'];?></td>
                                     
                  <td>
                  <a href="#addstatus<?php echo $row['order_id'];?>" data-toggle="modal"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> &nbsp;
                  <a href="product_ordercancel.php?resid=<?php echo htmlentities($row['order_id']); ?>"><svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.86 0-95.19-15.58-134.2-44.86c-14.14-10.59-17-30.66-6.391-44.81c10.61-14.09 30.69-16.97 44.8-6.375c27.84 20.91 61 31.94 95.89 31.94C344.3 415.8 416 344.1 416 256s-71.67-159.8-159.8-159.8C205.9 96.22 158.6 120.3 128.6 160H192c17.67 0 32 14.31 32 32S209.7 224 192 224H48c-17.67 0-32-14.31-32-32V48c0-17.69 14.33-32 32-32s32 14.31 32 32v70.23C122.1 64.58 186.1 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z" /></svg>
                                        </a> &nbsp;
                  <a href="product_formorder.php?rid=<?php echo htmlentities($row['order_id']);?>&&action=parmdel" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')"  title="Delete forever"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                  <?php include('product_status.php'); ?>
                  </td>
                </tr>

              <?php $cnt++;
              } ?>

            </tbody>
          </table>
          <?php
        $sql2  = "SELECT * from orders";
        $query2 = mysqli_query($conn, $sql2);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>
		
        <div class="pagination-nav pt-3">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="product_ordercancel.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="product_ordercancel.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="product_ordercancel.php?page=<?php echo $total_page;?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
            </ul>
        </nav>
		</div>
        </div>
      </div>
    </div>
   
   <?php include('DashboardScript.php') ?>

</body>

            