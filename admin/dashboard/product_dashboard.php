<?php  
  include('header_dashboard.php'); 
  error_reporting(0);

    if($_GET['action']=='del' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"UPDATE store set Is_Active='0' where Product_ID='$id'");
        $msg="ลบข้อมูลเสร็จสิ้น";
    }
    //restore
    if($_GET['resid']) {
        $id=intval($_GET['resid']);
        $query=mysqli_query($conn,"UPDATE store set Is_Active='1' where Product_ID='$id'");
        $msg="กู้คืนข้อมูลเสร็จสิ้น";
    }
    
    //Forever delete
    if($_GET['action']=='parmdel' && $_GET['rid']) {
        $id=intval($_GET['rid']);
        $query=mysqli_query($conn,"DELETE from store where Product_ID='$id'");
        $delmsg="ลบข้อมูลเสร็จสิ้น";
    }
?>

<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<body>

	<div class="container-fluid">
		<div class="bread-crump pt-2">
			<a href="adminDashboard.php">แดชบอร์ด</a> >
			<a href="#">จัดการสินค้าที่ระลึก</a> >
			<a href="product_dashboard.php">เพิ่ม/ลบ/แก้ใข</a> 
		</div>
	<div class="pt-2 header-product">
		<strong>จัดการเพิ่ม/ลบ/แก้ใข สินค้าที่ระลึก</strong>
	</div>	
	
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

	<div class="product-summary">
		<div class="col-lg-4 col-sm-6">
			<div class="row">
				
			</div>
		</div>
	</div>

	<span class="pull-left pb-3">
    <a href="#addnew" data-toggle="modal" class="btn btn-primary">
		<span class="glyphicon glyphicon-plus"></span>
		เพิ่มข้อมูล
	</a>
	</span>

    <table class="table table-colored-bordered table-bordered-primary mt-2">
		<thead>
		<th>#</th>
      	<th>รูปภาพ</th>
		<th>ชื่อสินค้า</th>
		<th>ประเภทสินค้า</th>
		<th>จำนวน</th>
		<th>ราคา (บาท/หน่วย)</th>
        <th>รายละเอียดสินค้า</th>
        <th>แก้ไข</th>
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
				
				$sql = "SELECT * from store WHERE Is_Active=1
                        ORDER BY created_at 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>
			<tr>
				<td><?php echo $count++; ?></td>
            	<td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt="" class="rounded"></td>
				<td><?php echo $row['productName']; ?></td>
				<td><?php echo $row['product_type']; ?></td>
				<td><?php echo $row['stock']; ?></td>
				<td><?php echo $row['Price']; ?></td>
            	<td style="width:20em;"><p class="detail"><?php echo $row['Description']; ?></p></td>
				<td>
				<a href="#receive<?php echo $row['Product_ID']; ?>" data-toggle="modal" class="button btn btn-warning">
						<span class="glyphicon glyphicon-edit"></span>
						นำเข้า
					</a> 
					<a href="#edit<?php echo $row['Product_ID']; ?>" data-toggle="modal" class="button btn btn-warning">
						<span class="glyphicon glyphicon-edit"></span>
						แก้ใข
					</a> 
					
					<a href="product_dashboard.php?rid=<?php echo htmlentities($row['Product_ID']);?>&&action=del" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')" class="btn btn-danger">ลบ</a>
						
						
				
					<?php include('product_edit_form.php'); ?>
					<?php include('product_receive_form.php'); ?>
					<?php include('product_delete_form.php'); ?>
				</td>
          	</tr>
			<?php } ?>
		</tbody>
	</table>

	

    <?php
        $sql2 = "SELECT * from store";
        $query2 = mysqli_query($conn, $sql2);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>
		
        <div class="pagination-nav pt-3">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="product_dashboard.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="product_dashboard.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="product_dashboard.php?page=<?php echo $total_page;?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
            </ul>
        </nav>
		</div>
    <?php include('product_add_form.php'); ?>
    <?php include('DashboardScript.php') ?>
	
	
</body>

