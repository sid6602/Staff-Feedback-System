<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $arr = json_decode($_POST['data']);
    // $arr = $_POST['data'];
    // echo($arr[0]['teacher']);

    $data = '';

    foreach ($arr as $value) {
        foreach ($value as $key => $val) {
            $data.="<p>{$key} - {$val}</p>";
        }
    }
echo($data);
    return $data;
}

?>