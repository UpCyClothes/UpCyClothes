<?php

function productNameCheck($procutName){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){ ////////////////////////여기부터
      $sql = "SELECT * from Product WHERE productName = '".$procutName."'";
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
        return 1;
      }else{
        return 0;
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);

}
//  $result = insertProduct($productName, $category, $productPrice, $productQuantity, $thumbnailURL, $detailURL);
function insertProduct($Name, $category, $price, $quantity,$thumbnailURL, $detailURL){
  session_start();
  if(isset($_SESSION['userId'])){
    $designer = $_SESSION['userId'];
  }else{
    $designer = "name-error";
  }
  $designer = getNickName($designer);
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $insertSQL = "INSERT INTO tempDB (Name ,designer, category, price, URL, content, quantity)";
      $insertSQL = $insertSQL." VALUES ('$Name','$designer','$category','$price','$thumbnailURL','$detailURL','$quantity')";
      $result = mysqli_query($mysqli,$insertSQL);
      return true;
  }
  else{
      return false;
  }
  mysql_close($mysqli);
}

function getNickName($user_id){
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
       return $row[4];
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getRegisterProduct(){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  session_start();
  if(isset($_SESSION['userId'])){
    $designer = $_SESSION['userId'];
  }else{
    $designer = "name-error";
  }
  $designer = getNickName($designer);
  if($mysqli){
      $sql = "SELECT ID from tempDB WHERE designer = '".$designer."'";
      $sql = $sql."and state = 0";
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

function getRegisterProductName($id){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  if($mysqli){
      $sql = "SELECT * from tempDB WHERE ID = ";
      $sql = $sql.$id;
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

function getRegisterProductComplete(){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $resultarray = array();
  session_start();
  if(isset($_SESSION['userId'])){
    $designer = $_SESSION['userId'];
  }else{
    $designer = "name-error";
  }
  if($mysqli){
      $sql = "SELECT ID from tempDB WHERE designer = '".$designer."'";
      $sql = $sql."and state = 1";
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

 ?>
