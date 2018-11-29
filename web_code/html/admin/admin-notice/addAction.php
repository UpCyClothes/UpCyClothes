<?php

include '../../../../control-admin/addNotice-controller.php';


$noticeType = $_POST["noticeType"];
$subject = $_POST["subject"];
$content = $_POST["content"];
$updated = date("Ymd");

addNotice($noticeType, $subject, $content, $updated);


 ?>
