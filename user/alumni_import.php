<?php
require('../template/header_user.php'); 
?>
<link rel="stylesheet" href="../assets/css/header.css">
<link rel="stylesheet" href="../assets/css/alumni.css">

<body>
    <div class="new-background">
        <div id="banner" style="background-image: url('../assets/img/decoration-img/kku-darker.jpg');">
            <div class="container">
                <div class="topic">
                    <!--<h1>&lt;GTCoding/&gt;</h1>-->

                    <h1 style="color:white;"><b>ศิษย์เก่าคณะวิทยาศาสตร์</b></h1>


                </div>
            </div>
        </div>
    </div>


    <div class="container" style="margin-top: 1em; margin-bottom:4em;">
        <div class="bread-crump mb-3">
            <a href="index.php">หน้าหลัก</a> >
            <a href="#">รายชื่อศิษย์เก่า</a>
        </div>
        <div class="filter-form pb-0">
            <form method="POST" action="alumni_import.php">
                <div class="how-to-use mb-3">
                    <h5>การใช้งานระบบสืบค้นศิษย์เก่า</h5>
                    <p class="text-defult mt-3">
                        - ระบุสาขา และระบุปีการศึกษาที่ต้องการสืบค้น (ปีการศึกษาที่เข้าศึกษา เช่น ขึ้นต้นด้วย 60 คือ ปีการศึกษา 2560)
                    </p>
                    <p class="text-defult">
                        - จำเป็นต้องระบุข้อมูลทั้ง 2 อย่าง ไม่สามารถระบุเฉพาะอย่างใดอย่างหนึ่งได้
                    </p>
                </div>
                <div class="mr-2 mb-2 input-group">
                    <input type="text" name="txtKeyword" id="txtKeyword" value="<?php //echo $strKeyword;?>" 
                     class="form-control" placeholder="สืบค้นศิษย์เก่า" onKeyup="filterSearchName();">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="mr-2 form-select form-control" name="field_of_study" id="field_of_study" onChange="filterSearchMajor()">
                            <option value="">สาขา</option>
                                <?php // Feching active Field Of Study
                                $fos=mysqli_query($conn,"SELECT fos_id,
                                                                fos_name
                                                        from field_of_study
                                                        where Is_Active=1
                                                        ");
                                while($result=mysqli_fetch_array($fos)) { ?>
                            <option value="<?php echo htmlentities($result['fos_name']);?>">
                                <?php echo htmlentities($result['fos_name']);?>
                            </option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <select class="form-select form-control" name="year" id="year" onChange="filterSearchYear()">
                            <option value="" selected>ปีการศึกษาที่เข้ารับการศึกษา</option>
                            <?php

                            $firstYear = ((int)date('Y') + 543) - 58;
                            $currentYear = $firstYear + 59;
                            for ($i = $firstYear; $i <= $currentYear; $i++) {
                                echo '<option value=' . substr($i,2,4) . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- <button class="ml-2 btn" type="submit" name="submit">ค้นหา</button>
                    <a class="ml-2 btn" href="alumni_import.php">ล้างข้อมูล</a> -->
                </div>
            </form>
        </div>

        
        <div class="alumni-table">          
            <div class="alumni-statistic mb-4">
                <div class="row">
                <!--
                    <div class="col-4">
                        <h5 class="text-center">ศิษย์เก่าทั้งหมด</h5>
                        <h3 class="text-center">
                            <?php  /*
                                $sql = "SELECT * FROM user";
                                if ($result=mysqli_query($conn,$sql)) {
                                    $rowcount=mysqli_num_rows($result);
                                    echo $rowcount-1; 
                                }
                            ?>
                        </h3>
                    </div>
                    <div class="col-4">
                    <h5 class="text-center">ศิษย์เก่าดีเด่น</h5>
                        <h3 class="text-center">
                            <?php 
                                $sql = "SELECT * FROM user";
                                if ($result=mysqli_query($conn,$sql)) {
                                    $rowcount=mysqli_num_rows($result);
                                    echo $rowcount; 
                                }
                            ?>
                        </h3>
                    </div>
                    <div class="col-4">
                    <h5 class="text-center">ศิษย์เก่าประจำปีการศึกษา 2564</h5>
                        <h3 class="text-center">
                            <?php 
                                $sql = "SELECT * FROM user WHERE start_year=2564";
                                if ($result=mysqli_query($conn,$sql)) {
                                    $rowcount=mysqli_num_rows($result);
                                    echo $rowcount; 
                                } */
                            ?>
                        </h3>
                    </div>
                -->
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
            
        </div>

    </div>
</body>

<script>
  function filterSearchName() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("txtKeyword");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[2];
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
  function filterSearchMajor() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("field_of_study");
    filter = input.value.toUpperCase();
    table = document.getElementById("data_table");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
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
  function filterSearchYear() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("year");
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



<?php require('../template/footer_users.php'); ?>