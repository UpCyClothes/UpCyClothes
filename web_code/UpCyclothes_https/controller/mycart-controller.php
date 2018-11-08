<?php
function insertCart($p_id, $p_number,$user_id,$t_price){
  /*부가정보 가져오기*/
  $total_price = $p_number*$t_price;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  /*부가 정보 얻어오는 SQL문*/
  $addInfoSQL = "SELECT * from Product Where productID =";
  $addInfoSQL = $addInfoSQL.$p_id;
  /*중복데이터 체크하는 SQL문*/
  if($mysqli){
    $result = mysqli_query($mysqli,$addInfoSQL);
    $array = mysqli_fetch_array($result);
    $productName = $array[1];
    $designer = $array[2];
    $p_url= $array[5];
    $sameCheckSQL = "SELECT * FROM Mycart WHERE user_ID ='".$user_id."'and productName = '".$productName."'";
    $sameresult = mysqli_query($mysqli,$sameCheckSQL);
    if(mysqli_num_rows($sameresult)==0){
      /*장바구니 새 데이터 삽입 SQL문*/
        $insertSQL = "INSERT INTO Mycart (productID, user_ID, designer, productName, count, price, productURL)";
        $insertSQL = $insertSQL." VALUES ('$p_id','$user_id','$designer','$productName','$p_number','$total_price','$p_url')";
        $result = mysqli_query($mysqli,$insertSQL);
        return '장바구니에 성공적으로 등록되었습니다.';
     }else{
       // 중복 데이터 있음.
       /*수량과 가격 업데이트 하면 됨.*/
       $nowCartArray = array();
       $nowCartArray = mysqli_fetch_array($sameresult);
       $nowCount = $nowCartArray[5];
       $nowPrice = $nowCartArray[6];
       $nowPrice = $total_price;
       $nowCount = $p_number;
       /*Update SQL문 작성*/
        $updateSQL = "UPDATE Mycart SET count =";
        $updateSQL = $updateSQL.$nowCount;
        $updateSQL = $updateSQL.", price = ".$nowPrice;
        $updateSQL = $updateSQL." WHERE user_ID ='".$user_id."'and productName = '".$productName."'";
        $updateResult = mysqli_query($mysqli,$updateSQL);
      return '장바구니에 추가로 등록되었습니다.';
   }

  }else {
    //디비 오류
    return 'sorry. DataBase is not connection.';
  }

  mysql_close($mysqli);

}

function getCart($user_id){
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT mycartID from Mycart WHERE user_ID = '".$user_id."'";
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

function getCartproductID($cardID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT * from Mycart WHERE mycartID = ";
      $sql = $sql.$cardID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $cardID;
      }else{
       return $array[1];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getDesigner($cardID){
    /*
    user_ID, designer, productName, count, price, productURL
    */
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT * from Mycart WHERE mycartID = ";
        $sql = $sql.$cardID;
        $result = mysqli_query($mysqli,$sql);
        $array = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)==0){
          return $cardID;
        }else{
         return $array[3];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);

  }

function getproductName($cardID){
    /*
    user_ID, designer, productName, count, price, productURL
    */
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT * from Mycart WHERE mycartID = ";
        $sql = $sql.$cardID;
        $result = mysqli_query($mysqli,$sql);
        $array = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)==0){
          return $cardID;
        }else{
         return $array[4];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);

  }
  //
  function getcount($cardID){
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT * from Mycart WHERE mycartID = ";
        $sql = $sql.$cardID;
        $result = mysqli_query($mysqli,$sql);
        $array = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)==0){
          return $cardID;
        }else{
         return $array[5];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
  }

  //
function getprice($cardID){
    /*
    user_ID, designer, productName, count, price, productURL
    */
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT * from Mycart WHERE mycartID = ";
        $sql = $sql.$cardID;
        $result = mysqli_query($mysqli,$sql);
        $array = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)==0){
          return $cardID;
        }else{
         return $array[6];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);

}

function getproductURL($cardID){
    /*
    user_ID, designer, productName, count, price, productURL
    */
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    $resultarray = array();
    if($mysqli){
        $sql = "SELECT * from Mycart WHERE mycartID = ";
        $sql = $sql.$cardID;
        $result = mysqli_query($mysqli,$sql);
        $array = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)==0){
          return $cardID;
        }else{
         return $array[7];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);

  }

function deleteCart($user_id,$cart_id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  if($mysqli){
    //userID = '".$id."'";
      $sql = "DELETE from Mycart WHERE mycartID =".$cart_id;
      $sql = $sql." and user_ID ='".$user_id."'";
      $result = mysqli_query($mysqli,$sql);
      return '삭제되었습니다.';
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}
 ?>
