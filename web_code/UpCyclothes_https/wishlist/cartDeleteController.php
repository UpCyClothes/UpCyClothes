<?php
include '../../../control/mycart-controller.php';
include '../../../control/controller.php';
$p_name = $_POST['p_name'];
$user_id = checkID();
if($user_id==False){
  echo "로그인 후 이용바랍니다.";
}else{
  echo deleteCart($user_id,$p_name);
}

?>
