<?php
header('Content-Type: text/html; charset=utf-8');
/*상품 등록을 위한 Controller*/
    include '../../../control/register-controller.php';
    $category = $_POST['category'];
    $productName = $_POST['title'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantitiy'];

    $result = insertProduct($productName, $category, $productPrice, $productQuantity);
    if($result == true){
      echo '<script type="text/javascript">
            alert("등록 되었습니다.");
            location.replace(\'../designer-product/designer-product-list.php\');
            </script>';
    }else{
      echo '<script type="text/javascript">
            alert("등록 과정에서 오류가 발생하였습니다.");
            history.back();
            </script>';
      echo("<script>location.replace('register/register.php');</script>");
    }
 ?>
