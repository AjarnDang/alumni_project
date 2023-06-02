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
                <a href="#">จัดการรายการบริจาคสิ่งของ</a>
            </div>
            <div class="pt-2 header-product">
                <strong>จัดการรายการบริจาคสิ่งของ</strong>
            </div>
            <hr>
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
                        <td style="width:1%;">
                        </td>
                        <td style="width:20%;">
                            <select name="typ" id="type_search" class="form-control border-input" onchange="filterSearchType()">
                                <option value="เครื่องแต่งกาย">เครื่องแต่งกาย</option>
                                <option value="อุปกรณ์การเรียน">อุปกรณ์การเรียน</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </td> 
                    </tr>
                </table>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!---Success Message--->
                    <?php if ($msg) { ?>
                        <div class="alert alert-success" role="alert">
                            <strong>สำเร็จ!</strong> <?php echo htmlentities($msg); ?>
                        </div>
                    <?php } ?>

                    <!---Error Message--->
                    <?php if ($delmsg) { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>ขออภัย</strong> <?php echo htmlentities($delmsg); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                
                    <table class="table table-striped table-bordered table-hover" id="data_table">
                        <thead>
                            
                            <th>รูปภาพ</th>
                            <th>ประเภท</th>
                            <th>ของที่ต้องการบริจาค</th>
                            <th>รายละเอียด</th>
                            <th>รูปแบบการจัดส่ง</th>
                            <th>วันที่/เวลานำส่ง</th>
                            <th>ผู้ส่ง</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>ยืนยัน</th>
                            <th>ยกเลิก</th>
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
				
				$sql = "SELECT * from donate_stuff  WHERE Is_Active=1
                        ORDER BY created_at 
                        DESC limit {$start} , {$perpage} ";
				$query = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($query)) {
			?>
                         
                                <tr>
                                    
                                    <td><img width="100" src="postimages/<?php echo $row['Picture']; ?>" alt=""></td>
                                    <td><?php echo $row['typ']; ?></td>
                                    <td><?php echo $row['item']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['mad']; ?></td>
                                    <td><?php echo formatDateFull($row['Datee']); ?></td>
                                    <td><?php echo $row['fullName']; ?></td>
                                    <td><?php echo $row['tel']; ?></td>
                                    
                                    <td><a href="donate_thing_manage.php?rid=<?php echo htmlentities($row['item_id']); ?>&&action=del">
                                    <span onclick="return confirm('คุณต้องการจะยืนยันหรือไม่ ?')" class="btn btn-success">ยืนยัน</span></a>
                                    <td><a href="donate_thing_manage.php?rid=<?php echo htmlentities($row['item_id']); ?>&&action=cen">
                                    <span onclick="return confirm('คุณต้องการจะยกเลิกหรือไม่ ?')" class="btn btn-danger">ยกเลิก</span></a>
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
                    <a href="donate_thing_manage.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				<?php for($i=1;$i<=$total_page;$i++){ ?>
				<li>
					<a href="donate_thing_manage.php?page=<?php echo $i; ?>">
						<?php echo $i; ?></a></li>
				<?php } ?>
				<li>
					<a href="donate_thing_manage.php?page=<?php echo $total_page;?>" aria-label="Next">
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
      td6 = tr[i].getElementsByTagName("td")[6];
      if (td || td6 || td5) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td5.innerHTML.toUpperCase().indexOf(filter) > -1 || td6.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
      td = tr[i].getElementsByTagName("td")[1];
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
  function filterSearchDate() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("dateSearch");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[5];
      if (td ) {
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
    
