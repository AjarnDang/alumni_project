<!-- Add New -->
<?php
	include('../../db/connection.php');
	$sql = "SELECT * FROM orders";
	$result= mysqli_query($conn, $sql);
	$id = $_GET['id'];
?>
<style>
	.row {
		margin: 1rem 0;
	}
</style>
<script>
	function changeContent1() {
	document.getElementById("show1").classList.remove("hide"); 
	}
	function changeContent2() {
	document.getElementById("show1").classList.add("hide");
	}
	
</script>
<style>.hide {display: none;}</style>

<div class="modal fade" id="addstatus<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">อัปเดตสถานะสินค้า</h4></center>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
                <?php

                $status=mysqli_query($conn,"SELECT * from orders  where order_id='".$row['order_id']."'");
                $row=mysqli_fetch_array($status);
                ?>
					<form method="POST" action="product_statusupdate.php?order_id=<?php echo $row['order_id'];?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-2">
							
							<label class="control-label">สถานะ:</label>
						</div>
						<div class="col-lg-10">
						<div><input type="radio"  value="ที่ต้องจัดส่ง"   name="statuss" onclick="changeContent2();"> ที่ต้องจัดส่ง</div>
						<div><input type="radio"  value="จัดส่งแล้ว"    name="statuss" onclick="changeContent1();" > จัดส่งแล้ว</div>
						<div><input type="radio"  value="ยกเลิกรายการ" name="statuss" onclick="changeContent1();" > ยกเลิกรายการ</div>
 						</div>
						</div>
						<div class="row">
						<div class="col-lg-2">
						</div>
						<div class="col-lg-10">
							<div id="show1" class="hide">
							<label class="control-label">หมายเหตุ:</label>
						 <input type="text" class="form-control mt-2" name="tacking">
						 </div>
						 
						</div>
					</div>
					
					
				
                   
				
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a> </button>
				</form>
                </div>
				
            </div>
        </div>
    </div>