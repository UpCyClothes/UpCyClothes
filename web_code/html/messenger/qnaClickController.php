<?php
    include '../../../control/qna-controller.php';
    header('Content-Type: text/html; charset=utf-8');
    $cat = $_POST['messengerID'];
    echo getDetailContentsJson($cat);
?>
