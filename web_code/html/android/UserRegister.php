<?php
    header('Content-Type: text/html; charset=utf-8');


    $connect=mysqli_connect( "localhost", "root", "316011", "upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
   $connect->set_charset('utf8');

    session_start();

   $userID = $_POST['userID'];
   $userPW = $_POST['userPW'];

   //for encryption
   $secret_key="123456789";
   $secret_iv="#$%^*()";

   $encrypted_pw=Encrypt($userPW,$secret_key,$secret_iv);

   $userName = $_POST['userName'];
   $nickName = $_POST['nickName'];
   $userType = $_POST['userType'];
   $zipcode = $_POST['zipcode'];
   $addr1 = $_POST['addr1'];
   $addr2 = $_POST['addr2'];
   $phnNum = $_POST['phnNum'];
   $email = $_POST['email'];
   $reception = $_POST['reception'];
   $tag1 = $_POST['tag1'];
   $tag2 = $_POST['tag2'];
   $token = $_POST['token'];
   $sql = "INSERT INTO user VALUES (null, '{$userID}','{$encrypted_pw}','{$userName}','{$nickName}','{$userType}','{$addr1}','{$addr2}'
     ,'{$zipcode}','{$phnNum}','{$email}','{$reception}','{$tag1}','{$tag2}','{$token}')"; //////////////////sql for modify
   $result = mysqli_query( $connect, $sql);


   $response = array();
   $response["success"]=true;
   echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

   function Encrypt($str, $secret_key='secret key', $secret_iv='secret iv')
   {
       //echo "in the encrypt fn";
       $key = hash('sha256', $secret_key);
       $iv = substr(hash('sha256', $secret_iv), 0, 32);

       return str_replace("=", "", base64_encode(
                    openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
       );
   }

   //복호화
   function Decrypt($str, $secret_key='secret key', $secret_iv='secret iv')
   {
       $key = hash('sha256', $secret_key);
       $iv = substr(hash('sha256', $secret_iv), 0, 32);

       return openssl_decrypt(
               base64_decode($str), "AES-256-CBC", $key, 0, $iv);
   }
?>
