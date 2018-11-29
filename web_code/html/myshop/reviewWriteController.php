<head>
  <meta charset="utf-8">
</head>

<?php
include '../../../control/buyitem-controller.php';

$product_id = $_POST['productID'];
$starPoint = $_POST['chk_info'];
$contents = $_POST['qcontents'];
$orderID = $_POST['orderID'];

wrtieReview($product_id, $orderID, $contents, $starPoint);


?>
