<?php

include '../../../../control-admin/registerProduct-controller.php';

$ID = $_POST["ID"];
$Name = $_POST["Name"];
$designer = $_POST["designer"];
$category = $_POST["category"];
$price = $_POST["price"];
$URL = $_POST["URL"];
$content = $_POST["content"];
$quantity = $_POST["quantity"];


insertData($ID, $Name, $designer, $category, $price, $URL, $content, $quantity);

?>
