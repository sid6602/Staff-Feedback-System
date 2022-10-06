<?php

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
    // else{
    //     echo "success";
    // }
    return $connection;
}
createConn();

?>