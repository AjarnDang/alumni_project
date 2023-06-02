<?php
include('header_dashboard.php');
error_reporting(0);

    if ($_GET['action'] == 'del' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($conn, "UPDATE donate_stuff set Is_Active='0' where item_id='$id'");
        $msg = "ลบข้อมูลเสร็จสิ้น";
    }
    //restore
    if ($_GET['resid']) {
        $id = intval($_GET['resid']);
        $query = mysqli_query($conn, "UPDATE donate_stuff set Is_Active='1' where item_id='$id'");
        $msg = "กู้คืนข้อมูลเสร็จสิ้น";
    }

    //Forever delete
    if ($_GET['action'] == 'parmdel' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($conn, "DELETE from donate_stuff where item_id='$id'");
        $delmsg = "ลบข้อมูลเสร็จสิ้น";
    }
    if ($_GET['action'] == 'cen' && $_GET['rid']) {
        $id = intval($_GET['rid']);
        $query = mysqli_query($conn, "UPDATE donate_stuff set Is_Active='2' where item_id='$id'");
        $msg = "ลบข้อมูลเสร็จสิ้น";
    }
?>
 <link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
    <body>
        <div class="container-fluid">
            <div class="bread-crump pt-2">
                <a href="adminDashboard.php">แดชบอร์ด</a> >
                <a href="#">บริจาคสิ่งของ</a> >
                <a href="#">ประวัติการยกเลิกบริจาค</a>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 style="font-size: 20px;" class="mb-2"></i>
                        ประวัติการยกเลิกบริจาค
                    </h5>
                    <table style="width:60%">
                    <tr>
                        <td style="width:0%;">
                        </td> 
                        <td style="width:20%;">
                            <input type="text" name="search" id="search" class="form-control border-input" onKeyup="filterSearch();" placeholder="ค้นหาจากของที่บริจาค,ชื่อผู้บริจาค">
                        </td>
                        <td style="width:1%;">
                        </td>
                        <td style="width:20%;">
                            <input type="text" class="form-control" name="Datee" id="dateSearch" placeholder="วัน/เดือน/ปี  " onKeyup="filterSearchDate()">
                        </td>
                        <td style="width:20%;">
                            
                        </td> 
                    </tr>
                </table>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            
                            <th>เวลานำส่ง</th>
                            <th>ของที่ต้องการบริจาค</th>
                            <th>รายระเอียด</th>
                            <th>รูปแบบการจัดส่ง</th>
                            <th>ชื่อผู้ส่ง</th>
                            <th>เบอร์โทร</th>
                            <th>หมายเหตุ</th>
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
				
				$sql = "SELECT * from donate_stuff  WHERE Is_Active=2
                        ORDER BY created_at 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>
                           
                                <tr>
                                    
                                    <td><?php echo formatDateFull($row['Datee']); ?></td>
                                    <td><?php echo $row['item']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['mad']; ?></td>
                                    <td><?php echo $row['fullName']; ?></td>
                                    <td><?php echo $row['tel']; ?></td>
                                    <td><!--<a href="activity_category_edit.php?cid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> &nbsp;-->
                                    <a href="donate_thing_manage.php?resid=<?php echo htmlentities($row['item_id']); ?>"><svg width="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M480 256c0 123.4-100.5 223.9-223.9 223.9c-48.86 0-95.19-15.58-134.2-44.86c-14.14-10.59-17-30.66-6.391-44.81c10.61-14.09 30.69-16.97 44.8-6.375c27.84 20.91 61 31.94 95.89 31.94C344.3 415.8 416 344.1 416 256s-71.67-159.8-159.8-159.8C205.9 96.22 158.6 120.3 128.6 160H192c17.67 0 32 14.31 32 32S209.7 224 192 224H48c-17.67 0-32-14.31-32-32V48c0-17.69 14.33-32 32-32s32 14.31 32 32v70.23C122.1 64.58 186.1 32.11 256.1 32.11C379.5 32.11 480 132.6 480 256z" /></svg>
                                        </a> &nbsp;
                                        <a href="donate_thing_manage.php?rid=<?php echo htmlentities($row['item_id']); ?>&&action=parmdel" onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่ ?')" title="Delete forever"><i class="fa fa-trash-o" style="color: #f05050"></i></a>
                                    </td>
                                </tr>
                                <?php $cnt++;
                                } ?>

                            </tbody>
                        </table>
                        <?php
        $sql2  = "SELECT * from donate_stuff";
        $query2 = mysqli_query($conn, $sql2);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>
		
        <div class="pagination-nav pt-3">
        <nav>
            <ul class="pagination">
                <li>
                    <a href="donate_cancel.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="donate_cancel.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="donate_cancel.php?page=<?php echo $total_page;?>" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
            </ul>
        </nav>
		</div>
                </div>
            </div>



        </div>

    </body>
    <?php include('DashboardScript.php') ?>