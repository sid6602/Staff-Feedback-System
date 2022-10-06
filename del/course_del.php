<?php
	include("../connection.php");

// Delete course with id
  $course_id_del=$_GET['del_course_id'];
  $sql= "DELETE FROM course WHERE id='$course_id_del'";
  $result= mysqli_query($connection, $sql) or die("Query Unsuccessful!!");
  echo "<script>window.open('../course_admin.php', '_self')</script>";


?>