<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"testerdb") or
        die( "SQL server can not connect to SQL server.");

    mysqli_query("set names utf8");

    session_start();

    $userID = $_POST['userID'];
    $result = mysqli_query($connect, "SELECT * FROM member WHERE userID='{$userID}'");
    $response = array();
    $response["success"]=false;
    if(mysqli_num_rows($result)==0){ //available
        $response["success"] = true;
        $response["userID"]=$userID;
    }
   echo json_encode($response);
?>
