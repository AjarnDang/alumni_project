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
			<a href="#">ประวัติการลบ</a> 
		</div>
        <div class="row mt-4">
        <div class="col-md-12">
                <h5 style="font-size: 20px;" class="mb-2"><i class="fa fa-trash-o"></i> 
                    ประวัติการลบ
                </h5>

                <div class="table-responsive">
                    <table class="table m-0 table-colored-bordered table-bordered-danger">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>สินค้า</th>
                            <th>ชื่อสินค้า</th>                              
                            <th>ราคา</th>
                            <th>รายระเอียดสินค้า</th>
                            <th>แอ็คชัน</th>
                            </tr>
                        </thead>

                        <tbody>
                    <?php 
                    $query=mysqli_query($conn,"SELECT *
                                                from store
                                            where Is_Active=0
                                            ");
                    $cnt=1;
                    while($row=mysqli_fetch_array($query)) { ?>

                        <tr>
                            <th scope="row"><?php echo $cnt++;?></th>
                            <td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt=""></td>
                            <td><?php echo $row['productName'];?></td>
                            <td><?php echo $row['Price'];?></td>
                            <td><?php echo $row['Description'];?></td>
                            <td>
                                <a href="product_dashboard.php?resid=<?php echo htmlentities($row['Product_ID']);?>">
                                    <svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.86 0-95.19-15.58-134.2-44.86c-14.14-10.59-17-30.66-6.391-44.81c10.61-14.09 30.69-16.97 44.8-6.375c27.84 20.91 61 31.94 95.89 31.94C344.3 415.8 416 344.1 416 256s-71.67-159.8-159.8-159.8C205.9 96.22 158.6 120.3 128.6 160H192c17.67 0 32 14.31 32 32S209.7 224 192 224H48c-17.67 0-32-14.31-32-32V48c0-17.69 14.33-32 32-32s32 14.31 32 32v70.23C122.1 64.58 186.1 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z"/></svg>
                                </a> &nbsp;
                                <a href="product_dashboard.php?rid=<?php echo htmlentities($row['Product_ID']);?>&&action=parmdel" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')" title="Delete forever">
                                    <i class="fa fa-trash-o" style="color: #f05050"></i>
                                </a>
                            </td>
                        </tr>

                    <?php $cnt++; } ?>
                
                    </tbody>
                </table>
            </div>
		</div>					
	</div><!--- end row -->
<?php include('DashboardScript.php') ?>

</body>

            