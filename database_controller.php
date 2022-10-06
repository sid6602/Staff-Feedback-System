<?php
include("connection.php");
// session_start();


// To restrict Student
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['restrict_student'])) {
        
        $email = $_POST['student_email'];
        // $fill_date = date("Y-m-d");

        // $sql_home="INSERT INTO student(  student_email, fill_date) VALUES (  '$email','$fill_date')";
        // mysqli_query(createConn(),$sql_home);


        $sql_restrict= "SELECT * FROM student WHERE student_email = '$email'";

      $result_restrict= mysqli_query($connection,$sql_restrict) or die("Query Uncessfull");
         // $sql_restrict;


      if(mysqli_num_rows($result_restrict) > 0){
            echo "You have already given feedback";
        // print_r($result_restrict);
      }
      else{
            echo "<script>window.open('feedback.html', '_self')</script>";
      }

     // echo "<script>window.open('feedback.html', '_self')</script>";
     
    }         
}


// Adding Faculty course allocation to table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_add_course_allocation'])) {
        
             $faculty_name=$_POST['faculty_name'];
             $faculty_email=$_POST['faculty_email'];
             $subject_name=$_POST['subject_name'];
             $subject_short_name=$_POST['subject_short_name'];
             $subject_type=$_POST['subject_type'];
             $division=$_POST['division'];
             $batch=$_POST['batch'];
             
            $sql_home="
            INSERT INTO course_allocation(  faculty_name, faculty_email,subject_name, subject_short_name, subject_type, batch, division) 
            VALUES (  '$faculty_name','$faculty_email' ,'$subject_name' ,'$subject_short_name' ,'$subject_type' ,'$division' ,'$batch')";
            
            mysqli_query(createConn(),$sql_home);

     echo "<script>window.open('course_allocation.php', '_self')</script>";
    }         
}


// To edit faculty course allocation
if (isset($_POST['submit_edit_course_allocation'])) {
    
            $faculty_course_id = $_POST['course_allocation_id'];
            $faculty_name=$_POST['faculty_name'];
            $faculty_email=$_POST['faculty_email'];
            $subject_name=$_POST['subject_name'];
            $subject_short_name=$_POST['subject_short_name'];
            $subject_type=$_POST['subject_type'];
            $division=$_POST['division'];
            $batch=$_POST['batch'];

     mysqli_query($connection, "UPDATE course_allocation SET faculty_name='$faculty_name ', faculty_email='$faculty_email' , subject_name='$subject_name' , subject_short_name ='$subject_short_name' , subject_type ='$subject_type' ,  batch='$batch' , division ='$division' WHERE id=$faculty_course_id");

     echo "<script>window.open('course_allocation.php', '_self')</script>";
}


// Adding Students to table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_add_student'])) {
        
             // $name=$_POST['faculty_name'];
             // $branch=$_POST['faculty_branch'];

             $student_name= $_POST['student_name'];
             $student_prn= $_POST['student_prn'];
             $student_email= $_POST['student_email'];
             $branch= $_POST['branch'];
             $division= $_POST['division'];
             $year= $_POST['year'];
             $addmission_year= $_POST['addmission_year'];
             // $response= $_POST['response'];


            $sql_home="INSERT INTO students(  name, prn, email, branch, division, year, addmission_year, response) VALUES (  '$student_name'  ,'$student_prn'   ,'$student_email'  ,'$branch'  ,'$division'  ,'$year'  ,'$addmission_year'  ,'0')";
            mysqli_query(createConn(),$sql_home);

     echo "<script>window.open('students.php', '_self')</script>";
    }         
}

// To edit Students

if (isset($_POST['submit_edit_student'])) {
    
             $student_id = $_POST['student_id'];
             $student_name= $_POST['student_name'];
             $student_prn= $_POST['student_prn'];
             $student_email= $_POST['student_email'];
             $branch= $_POST['branch'];
             $division= $_POST['division'];
             $year= $_POST['year'];
             $addmission_year= $_POST['addmission_year'];
             // $response= $_POST['response'];



    mysqli_query($connection, "UPDATE students SET name='$student_name'  , prn='$student_prn'  , email='$student_email' , branch='$branch' , division='$division' , year='$year' , addmission_year='$addmission_year' , response='0' WHERE student_id=$student_id");
    echo "<script>window.open('students.php', '_self')</script>";
}








// Adding faculty to table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_add_faculty'])) {
        
             $name=$_POST['faculty_name'];
             $branch=$_POST['faculty_branch'];
            $sql_home="INSERT INTO faculty(  name, department) VALUES (  '$name','$branch')";
            mysqli_query(createConn(),$sql_home);

     echo "<script>window.open('faculty_admin.php', '_self')</script>";
    }         
}



// To edit faculty
if (isset($_POST['submit_edit_faculty'])) {
    
    $faculty_id = $_POST['faculty_id'];
    $faculty_name = $_POST['faculty_name'];
    $new_banch = $_POST['faculty_branch'];
   
    mysqli_query($connection, "UPDATE faculty SET name='$faculty_name', department='$new_banch' WHERE id=$faculty_id");
    echo "<script>window.open('faculty_admin.php', '_self')</script>";
}




// Adding course to table
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit_add_course'])) {
        
            
             $name=$_POST['course_name'];
             $branch=$_POST['course_branch'];
            $sql_home="INSERT INTO course(  name, branch) VALUES (  '$name','$branch')";
            mysqli_query(createConn(),$sql_home);

     echo "<script>window.open('course_admin.php', '_self')</script>";
    }         
}



// To edit course 
if (isset($_POST['submit_edit_course'])) {
    
    $course_id = $_POST['course_id'];
    $course_name = $_POST['course_name'];
    $new_banch = $_POST['course_branch'];

    mysqli_query($connection, "UPDATE course SET name='$course_name', branch='$new_banch' WHERE id=$course_id");
    
    echo "<script>window.open('course_admin.php', '_self')</script>";
}









// function add_faculty($id, $name)
// {
//     $conn = createConn();
//     $sql = $conn->prepare("INSERT INTO faculty (id, name) VALUES ('$id' , '$name')");
//     $sql->bind_param("is", $id, $name);
//     if ($sql->execute()) {
//         $success = 1;
//     } else {
//         $success = -1;
//     }
// }

// function fetch_courses($branch, $batch, $division, $semester)
// {
//     $conn = createConn();
//     $sql = $conn->prepare("SELECT * FROM course_allocation where branch = ? and semester = ? and (batch = ? or batch = ?);");
//     $sql->bind_param("siss", $branch, $semester, $division, $batch);
//     $result = $conn->query($sql);
//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $course_name = get_course_name($row['course_id']);
//             $faculty_name = get_faculty_name($row['faculty_id']);
//             $feedback[$course_name] = $faculty_name;
//         }
//         return $feedback;
//     } else {
//         return "Invalid batch or branch";
//     }
// }

// function get_course_name($course_id)
// {
//     $conn = createConn();
//     $sql = $conn->prepare("SELECT name FROM course where id = ?");
//     $sql->bind_param("i", $course_id);
//     $sql->execute();
//     if ($sql->num_rows > 0) {
//         $result = $sql->get_result();
//         while ($data = $result->fetch_assoc()) {
//             return $data['name'];
//         }
//     } else {
//         return -1;
//     }
// }

// function get_faculty_name($faculty_id)
// {
//     $conn = createConn();
//     $sql = $conn->prepare("SELECT name FROM faculty where id = ?");
//     $sql->bind_param("i", $faculty_id);
//     $sql->execute();
//     if ($sql->num_rows > 0) {
//         $result = $sql->get_result();
//         while ($data = $result->fetch_assoc()) {
//             return $data['name'];
//         }
//     } else {
//         return -1;
//     }
// }

// function save_feedback($feedback)
// {
// }

// function create_feedback($semester, $division)
// {
// }

// $conn = createConn();