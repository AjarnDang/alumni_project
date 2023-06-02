
<?php

$conn = mysqli_connect("localhost","root","","alumni_sci");
$conn->set_charset("utf8");
require_once('excel_lib/php-excel-reader/excel_reader2.php');
require_once('excel_lib/SpreadsheetReader.php');

if(isset($_POST["Del"])){
   $query = mysqli_query($conn, "DELETE from import_file");
   $delmsg = "ลบข้อมูลเสร็จสิ้น";
}
 if (! empty($result)) {
    echo ("<script language='JavaScript'>
      alert('ลบข้อมูลเสร็จสิ้น');
      window.location.href='import_file.php';
      </script>"); 
}

if(isset($_POST["Import"])){
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){
    $targetPath = 'uploads/'.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

    $Reader = new SpreadsheetReader($targetPath);

    $sheetCount = count($Reader->sheets());

    for($i=0;$i<$sheetCount;$i++)
    {
      $Reader->ChangeSheet($i);

      foreach ($Reader as $Row)
      {

        $stu_id = "";
        if(isset($Row[0])) {
          $stu_id = mysqli_real_escape_string($conn,$Row[0]);
        }

        $firstname = "";
        if(isset($Row[1])) {
          $firstname = mysqli_real_escape_string($conn,$Row[1]);
        }

        $lastname = "";
        if(isset($Row[2])) {
          $lastname = mysqli_real_escape_string($conn,$Row[2]);
        }

        $majors = "";
        if(isset($Row[2])) {
          $majors = mysqli_real_escape_string($conn,$Row[3]);
        }

        if (!empty($stu_id) || !empty($firstname)|| !empty($lastname)) {
          $query = "insert into import_file (student_id, firstname, lastname, majors) values('".$stu_id."','".$firstname."','".$lastname."','".$majors."')";
          $result = mysqli_query($conn, $query);

          if (! empty($result)) {
            echo ("<script language='JavaScript'>
              alert('อัปโหลดข้อมูลเสร็จสิ้น.');
              window.location.href='import_file.php';
              </script>"); 
          } else {
            echo ("<script language='JavaScript'>
              alert('Invalid File:Please Upload CSV File.');
              window.location.href='import_file.php';
              </script>"); 
          }
        }
      }


    }
  }
  
  


    /*$filename=$_FILES["file"]["tmp_name"];    


     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
          
            $sql = "INSERT INTO student (student_id, firstname_th, lastname_th, class_room, room_number) values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$cr."','".$rn."')";
            $result = mysqli_query($con, $sql);



        if(!isset($result))
        {
              echo ("<script language='JavaScript'>
        alert('Invalid File:Please Upload CSV File.');
          window.location.href='../import_student.php';
          </script>"); 
        }
        else {
          echo ("<script language='JavaScript'>
        alert('CSV File has been successfully Imported.');
          window.location.href='../manage_student.php';
          </script>"); 
        }
           }
      
           fclose($file); 
         }*/
       }



       ?>