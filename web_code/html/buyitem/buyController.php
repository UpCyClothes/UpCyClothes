<head>
  <meta charset="utf-8">
</head>

<?php

include '../../../control/buyitem-controller.php';

$productID = $_POST['productID'];

if($productID==-1){
  $userID = $_POST['userID'];
  $receiverName = $_POST['userName'];
  $receiverAdd1 = $_POST['address1'];
  $receiverAdd2 = $_POST['address2'];
  $receiverZipcode = $_POST['postnum'];
  $receiverRequirement = $_POST['receiverRequirement'];
  $receiverTel = $_POST['receiverTel'];
  $quantity = -1;
  $totalprice = $_POST['totalprice'];
  $itemType = $_POST['itemType'];
  $itemList = $_POST['productList'];
  $quantityList = $_POST['quantityList'];
  $cartList = $_POST['cartList'];
  $orderState = 1;
  
  buyListInsert($cartList, $productID, $userID, $receiverName, $receiverAdd1, $receiverAdd2, $receiverZipcode, $receiverRequirement, $receiverTel, $quantity, $totalprice, $orderState,$itemType, $itemList, $quantityList);

}
else{
  $userID = $_POST['userID'];
  $receiverName = $_POST['userName'];
  $receiverAdd1 = $_POST['address1'];
  $receiverAdd2 = $_POST['address2'];
  $receiverZipcode = $_POST['postnum'];
  $receiverRequirement = $_POST['receiverRequirement'];
  $receiverTel = $_POST['receiverTel'];
  $quantity = $_POST['quantity'];
  $totalprice = $_POST['totalprice'];
  $itemType = $_POST['itemType'];
  $orderState = 1;
  buyInsert($productID, $userID, $receiverName, $receiverAdd1, $receiverAdd2, $receiverZipcode, $receiverRequirement, $receiverTel, $quantity, $totalprice, $orderState,$itemType);

}



?>
