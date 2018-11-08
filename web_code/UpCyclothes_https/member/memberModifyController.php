<head>
  <meta charset="utf-8">
</head>

<?php

  include '../../../control/controller.php';

  $zipCode = $_POST['postnum'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2']; //detail address


//비밀번호와 비밀번호 확인 문자열 확인

  if($password!=$password2){
    echo '<script type="text/javascript">
          alert("비밀번호와 비밀번호 확인이 서로 다릅니다.");
          history.back();
          </script>';
    echo("<script>location.replace('member/signup.php');</script>");
    exit();
  }

  //Tag List 분리해서 DB로 전송해주기.

//'$id','$password','$name','$userType','$nickname','$address1','$address2','$zipCode','$tel','$Email','$reception','$tag1','$tag2
 echo modifyUser($address1,$address2,$zipCode);


 ?>
