<?php
include_once 'config.php';
header('Content-Type: text/html; charset=utf-8');

function send_notification ($tokens, $message)
{


    $url = "https://fcm.googleapis.com/fcm/send";

    $fields = array('to' => $tokens,'data' => $message);

 // echo $tokens;
 // echo $message;

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

    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat =$_POST['messengerID'];
    $answer = $_POST['answer'];

    $q1 ="UPDATE messenger SET readmark=2, answer='".$answer."' WHERE messengerID=$cat";
    $result = mysqli_query($connect, $q1);

    $q2="SELECT userID FROM messenger WHERE messengerID=$cat";
    $result2 = mysqli_query($connect, $q2);
    $row = mysqli_fetch_array($result2);
    $userID=$row[userID];

    $q3 ="SELECT token FROM user WHERE userID='".$userID."'";
    $result3 = mysqli_query($connect, $q3);
    $row3 = mysqli_fetch_array($result3);
    $token=$row3[token];

    $myMessage = "1:1문의에 새로운 메시지가 왔습니다.";
    $message = array("message" => $myMessage);

    $message_status = send_notification($token, $message);
    //echo $message_status;

       $response = array();
       $response["success"]=true;
       echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

?>
