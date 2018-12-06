<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['messengerID'];
    $q1 = "UPDATE messenger SET readmark=1 WHERE messengerID=$cat";
    $result = mysqli_query($connect, $q1);

       $response = array();
       $response["success"]=true;
       echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

?>
