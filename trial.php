<?php

use Sabberworm\CSS\Value\Size;

function createConn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mitaoe";
    global $connection;
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    else{
        echo "success<br>";
    }
    return $connection;
}

function fetch_courses($branch, $batch, $division)
{
    $conn = createConn();
    $query = mysqli_query($conn, "SELECT * FROM course_allocation where branch = '$branch' and (batch = '$division' or batch = '$batch')");
    $feedback = array();
    while ($row = mysqli_fetch_assoc($query)) {     
        // print_r($row);   
        $course_name = get_course_name($row['course_id']);
            $faculty_name = get_faculty_name($row['faculty_id']);
            $form_row = array($row['course_id'],$course_name, $row['faculty_id'],$faculty_name);
            array_push($feedback, $form_row);
  
        }
        return $feedback;
}


    // $sql = $conn->prepare("SELECT * FROM course_allocation where branch = ? and (batch =".$batch." or batch)");
    // $sql->bind_param("s", $branch);
    // $sql->execute();
    // $feedback = array();
    // echo $sql->num_rows;
    // if ($sql->num_rows > 0) {
    //     $result = $sql->get_result();
    //     print_r($result);
    //     while ($row = $result->fetch_assoc()) {
    //         $course_name = get_course_name($row['course_id']);
    //         $faculty_name = get_faculty_name($row['faculty_id']);
    //         $form_row = array($row['course_id'],$course_name, $row['faculty_id'],$faculty_name);
    //         array_push($feedback, $form_row);
    //     }
    // }
    //     print_r($feedback);
    //     echo sizeof($feedback);
// }


function get_course_name($course_id)
{
    $conn = createConn();
    $sql = mysqli_query($conn,"SELECT name FROM course where id = '$course_id'");
    $row = mysqli_fetch_row($sql);
    
    return $row[0];
} 

function get_faculty_name($faculty_id)
{
    $conn = createConn();
    $sql = mysqli_query($conn,"SELECT name FROM faculty where id = '$faculty_id'");
    $row = mysqli_fetch_row($sql);
    return $row[0];
    // $sql = $conn->prepare("SELECT name FROM faculty where id = ?");
    // $sql->bind_param("i", $faculty_id);
    // $sql->execute();
    // if ($sql->num_rows > 0) {
    //     $result = $sql->get_result();
    //     while ($data = $result->fetch_assoc()) {
    //         return $data['name'];
    //     }
    // } else {
    //     return -1;
    // }
}

fetch_courses('IT', 'E2', 'E');

?>