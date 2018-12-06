<?php
header('Content-Type: text/html; charset=utf-8');

function getReviewCount($productID){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT reviewID from Review Where productID =".$productID;
      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
        return 0;
      }else{
        while ($row = mysqli_fetch_array($result)){
               $resultarray[] = $row[0];
        }
        return $resultarray;
      }

    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function getReviewPoint($reviewID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Review Where reviewID =".$reviewID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $boardID;
      }else{
       return $array[6];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getReviewer($reviewID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Review Where reviewID =".$reviewID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $boardID;
      }else{
       return $array[5];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getReviewContents($reviewID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Review Where reviewID =".$reviewID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $boardID;
      }else{
       return $array[4];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getReviewDate($reviewID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Review Where reviewID =".$reviewID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $boardID;
      }else{
       return $array[3];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

 ?>
