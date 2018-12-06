<?php

function getBoardCount($category){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT noticeID from Notice Where noticeType =";
      $sql = $sql.$category;
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

function getBoardTitle($boardID){
//Board 제목
$mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
$mysqli->set_charset('utf8');
if($mysqli){
    $sql = "SELECT * from Notice Where noticeID =";
    $sql = $sql.$boardID;
    $result = mysqli_query($mysqli,$sql);
    $array = mysqli_fetch_array($result);
    if(mysqli_num_rows($result)==0){
      return $boardID;
    }else{
     return $array[1];
    }
  }else {
    return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getBoardWriter(){
//Board 작성자
$writer = "Manager";
return $writer;
}

function getBoardDate($boardID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Notice Where noticeID =";
      $sql = $sql.$boardID;
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

function getBoardContents($boardID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Notice Where noticeID =";
      $sql = $sql.$boardID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $boardID;
      }else{
       return $array[2];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function getBoardImage($boardID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Notice Where noticeID =";
      $sql = $sql.$boardID;
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
 ?>
