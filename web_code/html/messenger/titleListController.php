<?php
  include '../../../control/qna-controller.php';
  header("Content-Type: text/html; charset=UTF-8");
  $designerID = $_POST['desingerID'];
  echo getTitleListJson($designerID);
 ?>
