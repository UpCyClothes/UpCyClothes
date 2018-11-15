<?php
include '../../../control/qna-controller.php';
header('Content-Type: text/html; charset=utf-8');

 $messengerID = $_POST['messengerID'];
 //readmark 확인
 $updateNeed = getUpdateNeed($messengerID);
 echo $updateNeed;

?>
