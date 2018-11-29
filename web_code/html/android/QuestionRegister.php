<?php
include_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

function send_notification ($tokens, $message)
{
    $url = "https://fcm.googleapis.com/fcm/send";
    $fields = array('to' => $tokens,'data' => $message);


    $headers = array('Authorization:key='.GOOGLE_API_KEY,'Content-Type: application/json');

    $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
         $result = curl_exec($ch);
         if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
         }
         curl_close($ch);

         return $result;

}
    $connect=mysqli_connect( "localhost", "root", "316011", "upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
   $connect->set_charset('utf8');

    session_start();

   $productID = $_POST['productID'];
   $messageDate = $_POST['messageDate'];
   $messageTitle = $_POST['messageTitle'];
   $messageContent = $_POST['messageContent'];
   $answer = $_POST['answer'];
   $userID = $_POST['userID'];
   $designerID = $_POST['designerID'];
   $readmark = $_POST['readmark'];

   $sql = "INSERT INTO messenger VALUES (null, '{$productID}','{$messageDate}','{$messageTitle}','{$messageContent}','{$answer}','{$userID}','{$designerID}','{$readmark}')"; //////////////////sql for modify
   $result = mysqli_query( $connect, $sql);
   //디자이너아이디

       $q3 ="SELECT token FROM user WHERE nickname='".$designerID."'";
       $result3 = mysqli_query($connect, $q3);
       $row3 = mysqli_fetch_array($result3);
       $token=$row3[token];

       $myMessage = "1:1문의에 새로운 메시지가 왔습니다.";
       $message = array("message" => $myMessage);

       $message_status = send_notification($token, $message);
   $response = array();
   $response["success"]=true;
   echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);


?>
