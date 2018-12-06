<?php

include '../../../../control-admin/product-controller.php';

$productID = $_GET["productID"];

deleteProduct($productID);

?>
