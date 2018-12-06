<?php
    header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");

    mysqli_query("set names utf8");

    session_start();

    $nickName = $_POST['nickName'];
    $result = mysqli_query($connect, "SELECT * FROM user WHERE nickName='{$nickName}'");
    $response = array();
    $response["success"]=false;
    if(mysqli_num_rows($result)==0){ //available
        $response["success"] = true;
        $response["nickName"]=$nickName;
    }
   echo json_encode($response);
?>
