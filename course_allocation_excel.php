<?php
session_start();

include("connection.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['course_allocation_excel_data'])) 
{
	$filename = $_FILES['import_file']['name'];
	$file_ext= pathinfo($filename, PATHINFO_EXTENSION);

	$allowed_ext =[ 'xls', 'csv', 'xlsx'];
	
	if(in_array($file_ext, $allowed_ext))
	{
		
		$inputFileNamePath = $_FILES['import_file']['tmp_name'];
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
		$data = $spreadsheet->getActiveSheet()->toArray();

		$count='0';
		foreach($data as $row)
		{
			if($count> 0)
			{

			
			$faculty_name= $row[0];
			$faculty_email = $row[1];
			$subject_name= $row[2];
			$subject_short_name=$row[3];
			$subject_type =$row[4];
			$division =$row[5];
			$batch = $row[6];

			$studentQuery ="INSERT INTO course_allocation(  faculty_name, faculty_email,subject_name, subject_short_name, subject_type, batch, division) 
            VALUES (  '$faculty_name','$faculty_email' ,'$subject_name' ,'$subject_short_name' ,'$subject_type' ,'$division' ,'$batch')";

            $result =mysqli_query(createConn(),$studentQuery);
            $msg =true;
            }
			else
			{
				$count='1';
			}
		}
		if(isset($msg))
		{
			$_SESSION['message']="Successfully Imported ";
			header('Location: course_allocation.php');
			exit(0);
		}
		else
		{
			$_SESSION['message']="NOT Imported ";
			header('Location: course_allocation.php');
			exit(0);
		}
	}
	else
	{
		$_SESSION['message']="Invalid File";
		header('Location: course_allocation.php');
		exit(0);
	}



}
?>