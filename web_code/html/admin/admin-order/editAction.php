<?php

include '../../../../control-admin/orderEdit-controller.php';

$orderID = $_POST["orderID"];
$productID = $_POST["productID"];
$userID = $_POST["userID"];
$orderState = $_POST["orderState"];


insertData($orderID, $productID, $userID, $orderState);

 ?>
