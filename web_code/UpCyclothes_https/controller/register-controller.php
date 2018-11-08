<?php

function productNameCheck($procutName){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){ ////////////////////////여기부터
      $sql = "SELECT * from Product WHERE productName = '".$procutName."'";
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
        return '사용 가능한 상품명입니다.';
      }else{
        return '중복되는 상품명입니다. 다른 상품명으로 등록하세요!';
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);

}

function insertProduct($Name, $category, $price, $quantity){
  session_start();
  if(isset($_SESSION['userId'])){
    $designer = $_SESSION['userId'];
  }else{
    $designer = "name-error";
  }
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $insertSQL = "INSERT INTO tempDB (Name ,designer, category, price, quantity)";
      $insertSQL = $insertSQL." VALUES ('$Name','$designer','$category','$price','$quantity')";
      $result = mysqli_query($mysqli,$insertSQL);
      return true;
  }
  else{
      return false;
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
