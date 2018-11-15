<?php
include '../../../control/qna-controller.php';
header('Content-Type: text/html; charset=utf-8');

$messageContent = $_POST['qcontents'];
$mID = $_POST['messengerID'];

$readmark = 2;

echo insertANSWER($mID,$messageContent);

?>
