<?php
include '../../../control/qna-controller.php';
header('Content-Type: text/html; charset=utf-8');
$productID = $_POST['productID'];
$messageTitle = $_POST['qtitle'];
$messageContent = $_POST['qcontents'];
$readmark = 0;
$userID = "Blank";

session_start();
if(isset($_SESSION['userId'])){
  $userID = $_SESSION['userId'];
}
$designerID = $_POST['designer'];

echo insertQNA($productID,$messageTitle,$messageContent,$readmark,$userID,$designerID);

?>
