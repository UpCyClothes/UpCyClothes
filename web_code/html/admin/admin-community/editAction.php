<?php

include '../../../../control-admin/communityEdit-controller.php';

$noticeID = $_POST["noticeID"];
$noticeType = $_POST["noticeType"];
$subject = $_POST["subject"];
$content = $_POST["content"];


insertData($noticeID, $noticeType, $subject, $content);

 ?>
