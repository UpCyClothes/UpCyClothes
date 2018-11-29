<head>
  <meta charset="utf-8">
</head>

<?php
// 회원저보 수정을 위한 컨트롤러이다.
  include '../../../control/controller.php';
  $name = $_POST['input_name'];
  $zipCode = $_POST['postnum'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2']; //detail address
  $tel = $_POST['tel1'].$_POST['tel2'].$_POST['tel3'];
  $email = $_POST['email'];
  $reception = $_POST['reception'];
  $v= count($_POST['consumer']);
  if($v>=2){
    $tag1 = $_POST['consumer'][0];
    $tag2 = $_POST['consumer'][1];

  }else{
    $tag1 = 0;
    $tag2 = 0;
  }
  if($reception !=1){
    $reception = 0;
  }
//'$id','$password','$name','$userType','$nickname','$address1','$address2','$zipCode','$tel','$Email','$reception','$tag1','$tag2
 echo modifyUser($name,$zipCode,$address1,$address2,$tel,$email,$reception,$tag1,$tag2);


 ?>
