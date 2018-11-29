<?php
  include '../../../control/controller.php';
  header("Content-Type: text/html; charset=UTF-8");
  $id = $_POST['id'];
  //1. 회원의 타입을 확인한다.
  if(checkType()==true){
      //if 디자이너 -> Product와 Messenger에 있는 값 모두 제거 후 user도 삭제 & 로그아웃 처리
      $byeDesigner = designerLeave($id);
  }else{
    //if 고객 -> Review와 Messenger에 있는 값 모두 제거 후 user도 삭제 & 로그아웃 처리
      $byeConsumer = consumerLeave($id);
  }
      echo "그동안 감사했습니다. 탈퇴 처리 되었습니다.";
 ?>
