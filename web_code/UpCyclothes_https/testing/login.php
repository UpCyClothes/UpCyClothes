<?php
header('Content-Type: text/html; charset=utf-8');
$connect=mysqli_connect('localhost', 'root', '316011','testerdb') or
    die( "can not connect to SQL server.");
   $connect->set_charset('utf8');
session_start();

if($connect){
  //echo "OK-Database Connect.";
  $connect->set_charset('utf8');
  //mysqil_select_db($connect);
  // $ID=isset($_POST['id']) ? $_POST['id'] : '';
  // $password=isset($_POST['pw']) ? $_POST['pw'] : '';
  $ID = $_POST['id'];
  $password = $_POST['pw'];
  //
   $secret_key="123456789";
   $secret_iv="#$%^*()";
   //$encrypted_pw=Encrypt($password,$secret_key,$secret_iv);
   //$decrypted_pw=Decrypt($encrypted_pw,$secret_key,$secret_iv);
//  echo "encrypted pw : ". $encrypted_pw. "<br />\n";
//  echo "decrypted pw : ". $decrypted_pw. "<br />\n";
  $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

  if ($ID != ""){

    $idchecking = mysqli_query($connect,"SELECT * FROM member WHERE userid='$ID'");

  	if(!mysqli_fetch_assoc($idchecking)){
      	echo "{\"status\":\"error\",\"memo\":\"Please check your ID\"}";}
  	else{
  	$data = array();

  	$sql = "SELECT userpw FROM member WHERE userid='$ID'";
    $result = mysqli_query($connect,$sql);
    $row =mysqli_fetch_array($result);

    //해당하는 사용자의 비밀번호를 복호화 한 것과 입력된 비밀번호가 같으면 로그인 성공!
    if(Decrypt($row["userpw"],$secret_key,$secret_iv) == $password){
      echo "{\"status\":\"OK\",\"memo\":\"1\"}";
    }

    $count = mysqli_num_rows($result);
  		if($count ==1){ //log in success
  			//$row =mysqli_fetch_array($result);
  			//array_push($data, array('id'=>$row["id"], 'userid'=>$row["userid"], 'password'=>$row["userpw"]));

        if(!$android){
      	echo "<pre>";
      	print_r($data);
      	echo "</pre>";
      	}
      	else{
      		    header('Content-Type: application/json; charset=utf8');
                      	$json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
                        //echo $json;
      	}
  		}

  		else{
  			echo "{\"status\":\"error\",\"memo\":\"Please check your password\"}";
  		}
     }
  	}

  	mysqli_free_result($result);

  mysqli_close($connect);



}
else{
  echo "Sorry";
}
//암호화
function Encrypt($str, $secret_key='secret key', $secret_iv='secret iv')
{
    //echo "in the encrypt fn";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 32)    ;

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
            base64_decode($str), "AES-256-CBC", $key, 0, $iv
    );
}


?>


<?php

$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

if (!$android){

?>


<?php
}


?>
