<?php
include '../database.php';
$campus_id = $_GET['campus_id'];



  echo"<SELECT name='fromoffice' id='fromoffice' class='form-control'>";
  echo "<OPTION value = '' disabled selected hidden>Select Office</OPTION>";
    $rs = mysqli_query($conn,'SELECT dept_id, dept_name, campus_id 
                from tbl_department WHERE campus_id='.$campus_id.' order by dept_name');
    while($rw = mysqli_fetch_array($rs)){
        echo'<option value="'.$rw['dept_name'].'">'.$rw['dept_name'].'</option>';
    }
    
  echo "</SELECT>";
?>

