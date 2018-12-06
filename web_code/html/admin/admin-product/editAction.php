<?php

include '../../../../control-admin/productEdit-controller.php';


$productID = $_POST["productID"];
$productName = $_POST["productName"];
$designer = $_POST["designer"];
$category = $_POST["category"];
$price = $_POST["price"];
$URL = $_POST["URL"];
$content = $_POST["content"];
$quantity = $_POST["quantity"];

insertData($productID, $productName, $designer, $category, $price, $URL, $content, $quantity);


 ?>
