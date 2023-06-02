<?php 
include('header_dashboard.php');
error_reporting(0);  
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="../plugins/summernote/summernote.css" rel="stylesheet" />
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
<link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
<link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
<script src="assets/js/modernizr.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link href="../../assets/css/defaultDashboard.css" rel="stylesheet" >
<style> a {text-decoration: none;}</style>
<body>
    <div class="container-fluid">
        <div class="bread-crump pt-2">
            <a href="adminDashboard.php">แดชบอร์ด</a> >
            <a href="#">ศิษย์เก่าดีเด่น</a> >
            <a href=" ">เพิ่มศิษย์เก่าดีเด่น</a> 
        </div>
        <div class="pt-2 header-product">
		    <strong>เพิ่มศิษย์เก่าดีเด่น</strong>
	    </div>
        <hr />      

        <div class="row justify-content-center">

            <div class="col-lg-10">  
                <!---Success Message---> <?php if($msg){ ?>
                <div class="alert alert-success" role="alert">
                    <strong>สำเร็จ!</strong> <?php echo htmlentities($msg);?>
                </div> <?php } ?>

                <!---Error Message---> <?php if($error){ ?>
                <div class="alert alert-danger" role="alert">
                    <strong>ขออภัย</strong> <?php echo htmlentities($error);?>
                </div> <?php } ?>
            </div>

            <div class="col-md-10 col-md-offset-1">
                <div class="p-6">   
                <form name="add_name" id="add_name" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-2 form-group mb-3">
                        <label for="exampleInputEmail1">คำนำหน้า</label>
                        <select name="hof_prefix" class="form-select" required>
                            <option value="">เลือกคำนำหน้า</option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                            <option value="ดร.">ดร.</option>
                            <option value="ผศ.ดร.">ผศ.ดร.</option>
                            <option value="อ.ดร.">อ.ดร.</option>
                            <option value="ศ.ดร">ศ.ดร</option>
                        </select>
                    </div>
                    <div class="col-5 form-group mb-3">
                        <label for="exampleInputEmail1">ชื่อจริง</label>
                        <input type="text" class="form-control" name="hof_firstname" placeholder="กรอกชื่อ" required>
                    </div>
                    <div class="col-5 form-group mb-3">
                        <label for="exampleInputEmail1">นามสกุล</label>
                        <input type="text" class="form-control" name="hof_lastname" placeholder="กรอกนามสกุล" required>
                    </div>
                    </div>                

                    <div class="row">     
                        <div class="col-6 form-group">
                            <label class="control-label">ตำแหน่ง/อาชีพปัจจุบัน</label>
                            <input type="text" class="form-control" name="hof_position" 
                                    placeholder="ex.อาจารย์มหาวิทยาลัย, ประธานบริษัท" value="">
                        </div>
                    
                        <div class="col-6 form-group mb-3">
                            <label class="control-label">วัน/เดือน/ปี เกิด</label>
                            <input type="date" class="form-control" name="hof_date_of_birth" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="header-title">ไบโอ (รายละเอียดแนะนำตัว)</label>
                        <input type="text" class="form-control" name="hof_description" 
                                placeholder="นายxxx ปัจจุบันประกอบอาชีพxxx เคยดำรงตำแหน่งxxx และสร้างชื่อเสียงในระดับสากล จากการเขียนงานวิจัยชื่อxxx"
                                required>
                    </div>

                    <div class="form-group">
                        <label for="header-title">ประวัติส่วนตัว</label>
                        <textarea class="summernote" rows="5" name="hof_history" required></textarea>
                    </div>
    
                    <div class="row">                    
                        <div class="col-lg-6 px-0 py-0">
                        <label class="control-label col-12">ความเชี่ยวชาญ</label>
							<table class="table table-borderless" id="dynamic_field">
							<tr>
							<td class="">
								<input type="text" name="mastery[]" class="form-control name_list" required/>
							</td>
							<td class="">
								<button type="button" name="add" id="add" class="btn btn-success">เพิ่มข้อมูล</button>
							</td>
							</tr>
							</table>
						</div>
						<div class="col-lg-6 px-0 py-0">
                        <label class="control-label col-12">รางวัลที่เคยได้รับ</label> 
							<table class="table table-borderless" id="dynamic_field_2">
							<tr>
							<td class="">
								<input type="text" name="reward[]" class="form-control name_list" required/>
							</td>
							<td class="">
								<button type="button" name="add2" id="add2" class="btn btn-success">เพิ่มข้อมูล</button>						
							</tr>
							</table>
						</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="header-title">ศิษย์เก่าดีเด่นประจำปี</label>
                                <input type="text" class="form-control" name="hof_year" placeholder="2562" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="header-title">ภาพประจำตัว (แนบลิ้งก์)</label>
                                <input type="text" class="form-control" name="hof_image" placeholder="https://www.example.com/image.jpg" required>
                            </div>
                        </div>
                    </div>
                    

					<!--
                    <div class="row">
                        <div class="col-4 form-group mt-2">
                            <label for="header-title">รูปภาพประจำตัว</label>
                            <input type="file" class="form-control" name="hof_image" required>
                        </div>
                    </div>
					-->
                      
                <div class="mb-4">                 
					<input type="button" name="submit" id="submit" class="btn btn-primary" value="ยืนยัน" />
                    <a href="hof_add.php" class="btn btn-danger waves-effect waves-light">
                        ยกเลิก
                    </a>
                </div>                      
                </form>
                
            </div> 
            
        </div>
                        
    </div>

<script>
$(document).ready(function(){
	//name_1
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row1'+i+'"><td><input type="text" name="mastery[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row1'+button_id+'').remove();
	});	
	

	//name_2
	var p=1;
	$('#add2').click(function(){
		p++;
		$('#dynamic_field_2').append('<tr id="row2'+p+'"><td><input type="text" name="reward[]" class="form-control name_list" /></td><td><button type="button" name="remove2" id="'+p+'" class="btn btn-danger btn_remove_2">X</button></td></tr>');
	});
	$(document).on('click', '.btn_remove_2', function(){
		var button_id = $(this).attr("id"); 
		$('#row2'+button_id+'').remove();
	});



	$('#submit').click(function(){		
		$.ajax({
			url:"hof_add_db.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_name')[0].reset();
			}
		});
	});	
});
</script>

    <script>var resizefunc = [];</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/summernote/summernote.min.js"></script>
    <script src="../plugins/select2/js/select2.min.js"></script>
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>      
    <script src="assets/pages/jquery.blog-add.init.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
    <script>
        jQuery(document).ready(function(){

            $('.summernote').summernote({
                height: 240,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                 // set focus to editable area after initializing summernote
            });
            // Select2
            $(".select2").select2();

            $(".select2-limiting").select2({
                maximumSelectionLength: 2
            });
        });
    </script>  
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/summernote/summernote.min.js"></script>   
       

    <?php include('DashboardScript.php') ?>
</body>
