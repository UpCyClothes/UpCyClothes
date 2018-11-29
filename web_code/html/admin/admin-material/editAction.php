<?php

include '../../../../control-admin/materialEdit-controller.php';

$materialID = $_POST["materialID"];
$materialName = $_POST["materialName"];
$material_Quantity = $_POST["material_Quantity"];
$matURL = $_POST["matURL"];


insertData($materialID, $materialName, $material_Quantity, $matURL);
// echo "materialID : " . $materialID . "<br>";
// echo "materialName : " . $materialName . "<br>";
// echo "material_Quantity : " . $material_Quantity . "<br>";
// echo "matURL : " . $matURL . "<br>";




 ?>
