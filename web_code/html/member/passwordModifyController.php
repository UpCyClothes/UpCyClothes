<head>
  <meta charset="utf-8">
</head>

<?php
//Check 유효성(for 비밀번호)
  include '../../../control/controller.php';
  $now = $_POST['now_password'];
  $new1 = $_POST['new_password1'];
  $new2 = $_POST['new_password2'];

  //now와 자신의 비번이 같은지 체크!
  $itsMe = modifyPassword($now);

  $pattern = '/^.*(?=^.{8,16}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/';

  if($itsMe==0){
    if($new1!=$new2){
      echo '<script type="text/javascript">
            alert("새로운 비밀번호와 비밀번호 확인이 서로 다릅니다.");
            history.back();
            </script>';
      exit();
    }else{

      if(strlen($new1)<8||strlen($new1)>16){
        echo '<script type="text/javascript">
              alert("변경 할 비밀번호는 8~16자로 입력하세요.");
              history.back();
              </script>';
      }else if(!preg_match($pattern,$new1)) {
        echo '<script type="text/javascript">
              alert("변경 할 비밀번호는 영문(대소문자구분),숫자,특수문자(~!@#$%^&*()-_? 만 허용)를 혼용하여주세요..");
              history.back();
              </script>';
      }else{
        $modifySuccess = modifyOK($new1);

      }
    }
  }else{
      echo '<script type="text/javascript">
            alert("현재 비밀번호를 정확히 입력하세요.");
            history.back();
            </script>';
  }


 ?>
