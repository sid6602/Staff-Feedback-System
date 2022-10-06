<?php
session_start();

include("connection.php");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['student_excel_data'])) 
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

			
			$name= $row[0];
			$prn = $row[1];
			$email= $row[2];
			$branch=$row[3];
			$division =$row[4];
			$year =$row[5];
			$addmission_year = $row[6];

			$studentQuery ="INSERT INTO students(  name, prn, email, branch, division, year, addmission_year, response) VALUES (  '$name'  ,'$prn'   ,'$email'  ,'$branch'  ,'$division'  ,'$year'  ,'$addmission_year'  ,'0')";

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
			header('Location: students.php');
			exit(0);
		}
		else
		{
			$_SESSION['message']="NOT Imported ";
			header('Location: students.php');
			exit(0);
		}
	}
	else
	{
		$_SESSION['message']="Invalid File";
		header('Location: students.php');
		exit(0);
	}



}
?>