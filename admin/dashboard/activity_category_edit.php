<?php
include('../../db/connection.php');
error_reporting(0);

    if(isset($_POST['submit'])) {
        $catid=intval($_GET['cid']);
        $category=$_POST['category'];
        $description=$_POST['description'];
        $query=mysqli_query($conn,"UPDATE events_category
                                      set CategoryName='$category',
                                          Description='$description',
                                          UpdationDate=now()
                                    where id='$catid'
                                    ");
        if($query) {
            $msg="อัปเดตข้อมูลสำเร็จ";
        } else {
            $error="มีบางอย่างผิดพลาด กรุณาลองใหม่อีกครั้ง";    
        } 
    }

    include('header_dashboard.php');
?>
<link rel="stylesheet" href="../../assets/css/defaultDashboard.css">

<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">กิจกรรม</a> >
            <a href=" ">แก้ใขหมวดหมู่กิจกรรม</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>แก้ใขหมวดหมู่กิจกรรม</strong>
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


        <?php 
        $catid=intval($_GET['cid']);
        $query=mysqli_query($conn,"SELECT id,
                                         CategoryName,
                                         Description,
                                         PostingDate,
                                         UpdationDate 
                                    from events_category
                                   where Is_Active=1
                                     and id='$catid'
                                     ");
        $cnt=1;
        while($row=mysqli_fetch_array($query)) { ?>
        	<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" name="category" method="post">
                            <div class="form-group">
                                <label class=" control-label">หมวดหมู่</label>                   
                                <input type="text" class="form-control" value="<?php echo htmlentities($row['CategoryName']);?>" name="category" required>                                
                            </div>                                            
                            <div class="form-group">
                                <label class=" control-label">คำอธิบาย</label>
                                    <textarea class="form-control" rows="5" name="description" required>
                                        <?php echo htmlentities($row['Description']);?>
                                    </textarea>                              
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class=" control-label">&nbsp;</label>               
                            <button type="submit" class="btn btn-success" name="submit">อัปเดต</button>                          
                        </div>
                        </form>
                    </div>
                </div>                       
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table m-0 table-borderless">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>หมวดหมู่</th>
                            <th>คำอธิบาย</th>
                            <th>แอ็คชั่น</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $query=mysqli_query($conn,"SELECT id,
                                                        CategoryName,
                                                        Description,
                                                        PostingDate,
                                                        UpdationDate
                                                    from events_category
                                                    where Is_Active=1
                                                ");
                        $cnt=1;
                        while($row=mysqli_fetch_array($query)) { ?>
                        <tr>
                            <th scope="row"><?php echo htmlentities($cnt);?></th>
                            <td><?php echo htmlentities($row['CategoryName']);?></td>
                            <td><?php echo htmlentities($row['Description']);?></td>
                            <td><a href="activity_category_edit.php?cid=<?php echo htmlentities($row['id']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> &nbsp;
                                <a href="activity_category_manage.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a>
                            </td>
                        </tr>

                        <?php $cnt++; } ?>

                        </tbody>                                  
                    </table>
                    </div>   
                    </div>
                </div>
                </div>
            </div>

            
    </div>
    <?php include('DashboardScript.php') ?>
</body>

