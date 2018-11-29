<?php
include '../../control/mycart-controller.php';
$p_id = $_POST['p_id'];
$p_number = $_POST['p_number'];
$t_price = $_POST['o_price'];
include '../../control/controller.php';
$user_id = checkID();
if($user_id==False){
  echo "notlogin";


}else{
  echo insertCart($p_id,$p_number,$user_id,$t_price);
}

?>
