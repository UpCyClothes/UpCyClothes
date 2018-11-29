<head>
  <meta charset="utf-8">
</head>

<?php

  include '../../../control/controller.php';

  $id = $_POST['input_id'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  $nickname = $_POST['nickname'];
  $name = $_POST['input_name'];
  $zipCode = $_POST['postnum'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2']; //detail address
  $tel = $_POST['tel1'] . $_POST['tel2'] . $_POST['tel3'];
  $email = $_POST['email'];
  $type = $_POST['type'];
  $reception = $_POST['reception'];
  $v= count($_POST['consumer']);
  if($v>=2){
    $tag1 = $_POST['consumer'][0];
    $tag2 = $_POST['consumer'][1];
  }else{
    $tag1 = 0;
    $tag2 = 0;
  }
//비밀번호와 비밀번호 확인 문자열 확인


  if($password!=$password2){
    echo '<script type="text/javascript">
          alert("비밀번호와 비밀번호 확인이 서로 다릅니다.");
          history.back();
          </script>';
    echo("<script>location.replace('member/signup.php');</script>");
    exit();
  }

 echo register($id,$password,$name,$type,$nickname,$address1,$address2,$zipCode,$tel,$email,$reception,$tag1,$tag2);


 ?>
