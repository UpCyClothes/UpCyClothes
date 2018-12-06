<?php
function buyProductName($p_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT productName from Product Where productID =";
     $sql = $sql.$p_id;
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[0];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function doWriteReview($order_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT orderState from orderList Where orderID =".$order_id;
     $result = mysqli_query($mysqli,$sql);
     $sql2 = "SELECT productID from orderList Where orderID =".$order_id;
     $result2 = mysqli_query($mysqli,$sql2);
     $sql3 = "SELECT productID from Review Where orderID =".$order_id;
     $result3 = mysqli_query($mysqli,$sql3);
  if(mysqli_num_rows($result)==0){
        return 0;
      }else{
        $row = mysqli_fetch_array($result);
        $row2 =  mysqli_fetch_array($result2);

        if($row[0]==5&&$row2[0]!=-1&&mysqli_num_rows($result3)==0){
            return 1;
        }else{
          return 0;
        }

      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function buyMaterialName($p_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT materialName from Material Where materialID =";
     $sql = $sql.$p_id;
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[0];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}
function buyUserAddress1($user_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[6];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}
function buyUserAddress2($user_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[7];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function buyUserZipcode($user_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
  }else{
        $row = mysqli_fetch_array($result);
       return $row[8];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}
function buyUserPhone($user_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[9];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function  buyUserName($user_id){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT * from user Where userID ='".$user_id."'";
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{
        $row = mysqli_fetch_array($result);
       return $row[3];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function buyInsert($productID, $userID, $receiverName, $receiverAddress1, $receiverAddress2, $receiverZipcode, $receiverRequirement, $receiverTel, $quantity, $totalprice, $orderState, $itemType){

    $messageDate = $messageDate = date("Y-m-d");
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $answer = "";
    if($mysqli){
        $sql = "INSERT INTO orderList VALUES (null,'{$productID}','{$userID}','{$receiverName}','{$receiverAddress1}','{$receiverAddress2}','{$receiverZipcode}','{$receiverRequirement}','{$receiverTel}','{$quantity}','{$messageDate}','{$totalprice}','{$orderState}','{$itemType}', null, null)";
        $result = mysqli_query($mysqli,$sql);
        echo("<script>
        alert('주문이 접수되었습니다. 이용해주셔서 감사합니다.');
        location.replace('../shoplist/shoplist.php');
        </script>");
    }
    else{
      echo("<script>
      alert('다시 시도해주세요.');
      location.replace('../index.php');
      </script>");
    }
    mysql_close($mysqli);
}

function deleteFromCart($cart_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  if($mysqli){
    //userID = '".$id."'";
    //orderState가져와서 1이면 OK 아니면 안됨.
    $stateSQL = "DELETE from Mycart WHERE mycartID = ".$cart_id;
    $result = mysqli_query($mysqli,$stateSQL);
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}
function buyListInsert($cartList, $productID, $userID, $receiverName, $receiverAddress1, $receiverAddress2, $receiverZipcode, $receiverRequirement, $receiverTel, $quantity, $totalprice, $orderState, $itemType, $list1, $list2){

    $messageDate = $messageDate = date("Y-m-d");
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $answer = "";
    if($mysqli){
        $sql = "INSERT INTO orderList VALUES (null,'{$productID}','{$userID}','{$receiverName}','{$receiverAddress1}','{$receiverAddress2}','{$receiverZipcode}','{$receiverRequirement}','{$receiverTel}','{$quantity}','{$messageDate}','{$totalprice}','{$orderState}','{$itemType}','{$list1}','{$list2}')";
        $result = mysqli_query($mysqli,$sql);
        //장바구니에 있는거 다 잘라.
        $cartArray =explode(':' , $cartList);
        $cnt = count($cartArray);
        for($i = 0 ; $i < $cnt ; $i++){
          deleteFromCart($cartArray[$i]);
        }
        echo("<script>
        alert('주문이 접수되었습니다. 이용해주셔서 감사합니다.');
        location.replace('../shoplist/shoplist.php');
        </script>");
    }
    else{
      echo("<script>
      alert('다시 시도해주세요.');
      location.replace('../index.php');
      </script>");
    }
    mysql_close($mysqli);
}

function getBuyItemList($user_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT orderID from orderList WHERE userID = '".$user_id."'";
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
         return "0";
       }else{
         while ($row = mysqli_fetch_array($result)){
           $resultarray[] = $row[0];
         }
        return $resultarray;
       }
   }
   else{
       return 'sorry. DataBase is not connection.';
   }
   mysql_close($mysqli);
}

function buyProductList($order_id){

  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT itemList from orderList WHERE orderID = ".$order_id;
     $result = mysqli_query($mysqli,$sql);
     $row = mysqli_fetch_array($result);
     if(mysqli_num_rows($result)==0){
        return "system-error";
      }else{

        //for문으로 잘라서 돌리기
        $productArray =explode(':' , $row[0]);
        $totalProduct = "";
        $cnt = count($productArray);
        $productNArray = array();
        for($i = 0 ; $i < $cnt ; $i++){
          $productNArray[$i] = buyProductName($productArray[$i]);
          if($i==0){
            $totalProduct = $totalProduct.$productNArray[$i];
          }else{
            $totalProduct = $totalProduct.",".$productNArray[$i];
          }


        }

       return $totalProduct;
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function orderProductName($order_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT * from orderList WHERE orderID = ".$order_id;
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
         return "system-error";
       }else{
         $row = mysqli_fetch_array($result);
         if($row[1]!=-1){
          $productName = buyProductName($row[1]);
          return $productName;
        }else{
          $productName = buyProductList($order_id);
          return $productName;
        }


       }
   }
   else{
       return 'sorry. DataBase is not connection.';
   }
   mysql_close($mysqli);
}

function orderMaterialName($order_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT * from orderList WHERE orderID = '".$order_id."'";
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
         return "system-error";
       }else{
         $row = mysqli_fetch_array($result);
         $productName = buyMaterialName($row[1]);
         return $productName;
       }
   }
   else{
       return 'sorry. DataBase is not connection.';
   }
   mysql_close($mysqli);
}

function orderProductID($order_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT productID from orderList WHERE orderID = '".$order_id."'";
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
         return "system-error";
       }else{
         $row = mysqli_fetch_array($result);
         return $row[0];
       }
   }
   else{
       return 'sorry. DataBase is not connection.';
   }
   mysql_close($mysqli);
}

function orderInformation($order_id){


  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT * from orderList WHERE orderID = '".$order_id."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $cardID;
      }else{
       return $array;
      }
   }
   else{
       return 'sorry. DataBase is not connection.';
   }
   mysql_close($mysqli);
}

function wrtieReview($productID, $orderID, $reviewContent, $starpoint){
  session_start();
  if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
  }else{
    $user_id = "name-error";
  }
  $reviewDate = date("Y-m-d");
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $insertSQL = "INSERT INTO Review (productID ,orderID, reviewDate, reviewContent, userID, starpoint)";
      $insertSQL = $insertSQL." VALUES ('$productID','$orderID','$reviewDate','$reviewContent','$user_id','$starpoint')";
      $result = mysqli_query($mysqli,$insertSQL);
      echo("<script>
          alert('리뷰를 남겨주셔서 감사합니다.');
          location.replace('../index.php');
          </script>");
  }
  else{
      echo("<script>
                alert('리뷰를 다시 남겨주세요.');
                location.replace('../index.php');
                </script>");
  }
  mysql_close($mysqli);
}

function deleteOrder($order_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  if($mysqli){
    //userID = '".$id."'";
    //orderState가져와서 1이면 OK 아니면 안됨.
    $stateSQL = "SELECT orderState from orderList WHERE orderID = ".$order_id;
    $result = mysqli_query($mysqli,$stateSQL);
    $row = mysqli_fetch_array($result);
    if($row[0]==1){
      $sql = "DELETE from orderList WHERE orderID = ".$order_id;
      $result = mysqli_query($mysqli,$sql);
      return '주문이 정상 취소되었습니다.';
    }else{
      return '주문이 진행중입니다. 관리자에게 문의하세요.';
    }

  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

 ?>
