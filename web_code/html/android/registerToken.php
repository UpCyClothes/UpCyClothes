<?php
header('Content-Type: text/html; charset=utf-8');


$conn=mysqli_connect( "localhost", "root", "316011", "upcyclothes_db") or
    die( "SQL server can not connect to SQL server.");
$conn->set_charset('utf8');

session_start();


$token = $_POST['token'];
$user_id= $_POST['user_id'];
$db_sql = "update user set token='".$token."' where userID='".$user_id."'";
mysqli_query($conn, $db_sql);

$response = array();
$response["success"]=true;
echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>
