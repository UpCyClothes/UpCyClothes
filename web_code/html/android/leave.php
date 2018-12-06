<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['userID'];
    $cat2 = $_POST['nickname'];

    $q1 = "DELETE FROM user WHERE userID='".$cat."'";
    $q2 = "DELETE FROM messenger WHERE userID='".$cat."' OR designerID='".$cat2."'";
    $q3=  "DELETE FROM Mycart WHERE  user_ID='".$cat."' OR designer='".$cat2."'";
    $q4=  "DELETE FROM orderList WHERE  userID='".$cat."'";
    $q5=  "DELETE FROM Product WHERE  designer='".$cat2."'";
    $q6=  "DELETE FROM Review WHERE  userID='".$cat."'";
    $q6=  "DELETE FROM tempDB WHERE  designer='".$cat2."'";

    $result = mysqli_query($connect, $q1);
    $result = mysqli_query($connect, $q2);
    $result = mysqli_query($connect, $q3);
    $result = mysqli_query($connect, $q4);
    $result = mysqli_query($connect, $q5);
    $result = mysqli_query($connect, $q6);

    $total_record = mysqli_num_rows($result);
    $response = array();
    $response["success"]=true;
     echo json_encode($response);

?>
