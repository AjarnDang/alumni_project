<?php 
  include('header_dashboard.php');
	error_reporting(0);
	if(strlen($_SESSION['username'])=='admin') { 
		header('location:../../login-system/login_form.php');
	} else {
		if($_GET['action']=='del' && $_GET['rid']) {
			$id=intval($_GET['rid']);
			$query=mysqli_query($conn,"UPDATE orders set staytus='ชำระเงินแล้ว' where order_id='$id'");
			$msg="ยืนยันออเดอร์";
		}
		//restore
		if($_GET['resid']) {
			$id=intval($_GET['resid']);
			$query=mysqli_query($conn,"UPDATE orders set staytus='รอการตรวจสอบ' where order_id='$id'");
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
			$query=mysqli_query($conn,"UPDATE orders set staytus='ยกเลิกรายการ' where order_id='$id'");
			$msg="ยกเลิกออเดอร์";
		}
   
?>

<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">  

            <!---Success Message--->  
            <?php if($msg) { ?>
                <div class="alert alert-success" role="alert">
                    <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
                </div>
            <?php } ?>

            <!---Error Message--->
            <?php if($delmsg) { ?>
                <div class="alert alert-danger" role="alert">
                    <strong>ขออภัย</strong> <?php echo htmlentities($delmsg);?>
                </div>
            <?php } ?>

            </div>
        </div>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
	<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">จัดการสินค้าที่ระลึก</a> >
			<a href="product_formorder.php">รายการสั่งซื้อ</a> 
		</div>
	<div class="pt-2 header-product">
		<strong>รายการสั่งซื้อ</strong>
	</div>	
  <div class="row mt-4">
                <div class="col-md-12">
                <table style="width:60%">
                    <tr>
                        <td style="width:0%;">
                        </td> 
                        <td style="width:5%;">ค้นหา: 
                        </td> 
                        <td style="width:30%;"> 
                            <input type="text" name="search" id="search" class="form-control border-input" onKeyup="filterSearch();" placeholder="ค้นหาจากเลขออเดอร์,ชื่อลูกค้า">
                        </td>
                        <td style="width:1%;">
                        </td>
                        <td style="width:14%;">สถานะการชำระเงิน: 
                        </td> 
                        <td style="width:20%;"> 
                            <select name="staytus" id="type_search1" class="form-control border-input" onchange="filterSearchType1()">
                            <option readonly>การชำระเงิน</option>
                                <option value="รอการตรวจสอบ">รอการตรวจสอบ</option>
                                <option value="ชำระเงินแล้ว">ชำระเงินแล้ว</option>
                                <option value="ยกเลิกรายการ">ยกเลิกรายการ</option>
                            </select>
                        </td> 
                        <td style="width:1%;">
                        </td>
                        <td style="width:13%;">สถานะการจัดส่ง: 
                        </td>
                      
                        <td style="width:20%;">
                            <select name="statuss" id="type_search" class="form-control border-input" onchange="filterSearchType()">
                            <option readonly>สถานะ</option>
                                <option value="ที่ต้องจัดส่ง">ที่ต้องจัดส่ง</option>
                                <option value="จัดส่งแล้ว">จัดส่งแล้ว</option>
                                <option value="ยกเลิกรายการ">ยกเลิกรายการ</option>
                            </select>
                        </td>
                        <td style="width:200%;">
                        </td>
                        </td> 
                    </tr>
                </table>
                    <table class="table table-striped table-bordered table-hover" id="data_table">
          <thead>
            <th>ลำดับ</th>  
            <th>เลขคำสั่งซื้อ</th>
            <th>ชื่อลูกค้า</th>
            <th>วันที่/เวลาสั่งซื้อ</th>
            <th>รวมทั้งหมด</th>
            <th>การชำระเงิน</th>
            <th>สถานะ</th>
            <th>จัดการสถานะ</th>
            <th>ดำเนิดการ?</th>
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
				
				$sql = "SELECT * from orders 
                        ORDER BY created_at 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>
      
                  
        <tr>
              <td><?php echo $count++ ?></td>
              <td><?php echo $row['order_id']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['created_at']; ?></td>
              <td>฿<?php echo $row['totalprice']; ?></td>
              <td><?php echo $row['staytus'];?></td>
              <td><?php echo $row['statuss'];?></td>
              <td>
                <?php if($row['staytus'] == "ชำระเงินแล้ว"){ ?>
                <a href="#addstatus<?php echo $row['order_id'];?>" class="btn btn-primary" data-toggle="modal">จัดการสถานะ</a><?php include('product_status.php'); ?>
                <?php }else{ ?>
                  <span style="color:red;">รอการชำระ</span>
                <?php } ?>
              </td>
               
                <td>
                
                
                  <a href="product_order_info.php?id=<?php echo($row['order_id']);?>" class="btn btn-primary">รายละเอียด</a>
                  
      			</td>
      </tr>
    <?php $cnt++;
            } ?>

    </tbody>
    </table>
    <?php } ?>
   
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
                    <a href="product_formorder.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="product_formorder.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="product_formorder.php?page=<?php echo $total_page;?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
            </ul>
        </nav>
		</div>
                </div>
            </div>
        </div>
    <script>
  function filterSearch() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      td5 = tr[i].getElementsByTagName("td")[2];
     
      if (td || td5) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1 ) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>
   <script>
  function filterSearchType() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("type_search");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[6];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>
   <script>
  function filterSearchType1() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("type_search1");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>
    <?php include('DashboardScript.php') ?>

    </body>
    