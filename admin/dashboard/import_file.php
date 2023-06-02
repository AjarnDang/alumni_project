<?php
include('../../db/connection.php');
include('header_dashboard.php');
error_reporting(0);
    
    if(isset($_GET['del'])) {
        //$id=intval($_GET['rid']);
        $query = mysqli_query($conn, "DELETE from import_file");
        echo ("<script language='JavaScript'>
		alert('ลบข้อมูลเสร็จสิ้น');
		window.location.href='import_file.php';
		</script>"); 
    }
    
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">
<style>a {text-decoration: none;}</style>
<body>
   
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่า</a> >
            <a href="./alumni_manage.php">เพิ่มศิษย์เก่า</a>
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มศิษย์เก่า</strong>
	    </div>
        <hr/> 

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">             
            <!---Success Message--->  
            <?php if($msg){ ?>
            <div class="alert alert-success" role="alert">
                <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
            </div>
            <?php } ?>

            <!---Error Message--->
            <?php if($error){ ?>
            <div class="alert alert-danger" role="alert">
                <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
            </div>
            <?php } ?>
            </div>
        </div>
              
        	<div class="row">   
                <div class="col-lg-6 col-md-6 col-sm-12 p-0">        
                <form action="csv_import.php" method="post"name="frmExcelImport" id="frmExcelImport" class="form-horizontal" enctype="multipart/form-data">
	                    <div class="form-group">
	                        <label class="col-md-12 control-label">CSV / XLSX</label>
	                        <div class="col-md-12">
                                <input type="file" name="file" class="form-control" id="file" accept=".xls,.xlsx">
                                
	                        </div>
	                    </div>
	                        

                                                   
                    </div>

               
            
                 <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                    <div class="form-group">
                        <label class="col-md-12 control-label">&nbsp;</label>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" name="Import">
                                เพิ่มข้อมูล
                            </button> 
                            <form action="csv_import.php" method="post"name="frmExcelImport" id="frmExcelImport" class="form-horizontal" enctype="multipart/form-data">
                             
                            <a href="?del=true" class="btn btn-danger">ลบข้อมูล</a>
                            </form>           
                        </div>
                    </div>
                 </div>
         
	        </form>               
                
        </div>   
    </div>
            
    <table class="table table-borderless" id="data_table">
                <thead>
                    <th>ลำดับ</th>
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อ</th>
                    <th>สาขา</th>
                    <!--<th>ข้อมูลเพิ่มเติม</th>-->
                </thead>
                <tbody>
                    <?php
                     $count = 1;
                    
                    $query = mysqli_query($conn,"SELECT * FROM import_file");
                            
                         while ($row = $query->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                            <td><?php echo $row['majors']; ?></td>
                            <!--<td><a href="alumni_detail.php?id=<?php //echo $row['id'] ?>">ดูข้อมูล</a></td>-->
                        </tr>                   
                    <?php } ?>
                    
                </tbody>
            </table>
    
    <script src="script.js"></script>
    <script src="jquery.min.js"></script>
    
    <?php include('DashboardScript.php'); ?>
</body>