<?php 
include("../connection.php");

// Delete faculty with id
  $faculty_id_del=$_GET['del_faculty_id'];
  $sql= "DELETE FROM faculty WHERE id='$faculty_id_del'";
  $result= mysqli_query($connection, $sql) or die("Query Unsuccessful!!");
   echo "<script>window.open('../faculty_admin.php', '_self')</script>";

  ?>
