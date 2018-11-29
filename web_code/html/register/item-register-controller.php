<?php
header('Content-Type: text/html; charset=utf-8');
/*상품 등록을 위한 Controller*/
    include '../../../control/register-controller.php';
    $category = $_POST['category'];
    $productName = $_POST['title'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantitiy'];

    session_start();
    if(isset($_SESSION['userId'])){
      $userID = $_SESSION['userId'];
    }else{
      $userID = "error_id";
    }

    $uploadBase = '../upload/';
    $uploadOk = 1;
    $insertOK = 1;
    $tmp_name = $_FILES['thumbnail']['tmp_name'];
    $filename1 = "thumbImage_".$userID.'_'.$_FILES['thumbnail']['name']; //썸네일

    if($_FILES['detail']['tmp_name'][0]==""){
      echo '<script type="text/javascript">
            alert("모든 빈칸을 채워주세요.");
            history.back();
            </script>';
      echo("<script>location.replace('register/register.php');</script>");
    }

    $check2 = getimagesize($_FILES["thumbnail"]["tmp_name"]);
    if($check2 == false) {
      echo '<script type="text/javascript">
            alert("이미지 형식 오류가 발생하였습니다.");
            history.back();
            </script>';
        $uploadOk = 0;
        $insertOK = 0;
        break;
    }
    foreach ($_FILES['detail']['tmp_name'] as $f => $name) {
        $check = getimagesize($_FILES["detail"]["tmp_name"][$f]);
        if($check == false) {
          echo '<script type="text/javascript">
                alert("이미지 형식 오류가 발생하였습니다.");
                history.back();
                </script>';
            $uploadOk = 0;
            $insertOK = 0;
            break;
        }
    }
    //
    if($uploadOk==1){ //image-server에 올라갈 수 있음.

      if(move_uploaded_file( $tmp_name, $uploadBase . $filename1)){
          $uploadOk = 1;
          $insertOK = 1;
      }else{
           $uploadOk = 0;
           $insertOK = 0;
      }

      foreach ($_FILES['detail']['name'] as $f => $name) {
          $name = $userID.$_FILES['detail']['name'][$f];
          $uploadName = explode('.', $name);
          // $fileSize = $_FILES['upload']['size'][$f];
          $fileType = $_FILES['detail']['type'][$f];
          $uploadname = "detailImage_".$userID.'_'.$f.'.'.$uploadName[1];
          $uploadFile = $uploadBase.$uploadname;

          if(move_uploaded_file($_FILES['detail']['tmp_name'][$f], $uploadFile)){
            $uploadOk = 1;
            $insertOK = 1;
          }else{
            $uploadOk = 0;
            $insertOK = 0;
          }
      }
    }

    if($insertOK==1){
      $thumbnailURL = "/upload/".$filename1;
      $detailURL = "/upload/".$uploadname;

      $result = insertProduct($productName, $category, $productPrice, $productQuantity, $thumbnailURL, $detailURL);
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
    }else{
      echo '<script type="text/javascript">
            alert("이미지 등록 과정에서 오류가 발생하였습니다.");
            history.back();
            </script>';
      echo("<script>location.replace('register/register.php');</script>");
    }

 ?>
