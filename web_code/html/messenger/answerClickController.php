<?php
  include '../../../control/qna-controller.php';
  header("Content-Type: text/html; charset=UTF-8");
  $cat = $_POST['messengerID'];
  echo writeContentsJson($cat);
 ?>
