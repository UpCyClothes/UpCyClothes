<?php
function getproduct($category){
  
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
     $sql = "SELECT productID from Product Where category =";
     $sql = $sql.$category;
     $result = mysqli_query($mysqli,$sql);
  if(mysqli_num_rows($result)==0){
        return "Fail";
      }else{
        //echo '<br>';
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

function boardName($productID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Product Where productID =";
      $sql = $sql.$productID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $productID;
      }else{
       return $array[1];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function writerName($productID){
#작가 ID받아오는 곳.
$mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
$mysqli->set_charset('utf8');
if($mysqli){
    $sql = "SELECT * from Product Where productID =";
    $sql = $sql.$productID;
    $result = mysqli_query($mysqli,$sql);
    $array = mysqli_fetch_array($result);
    if(mysqli_num_rows($result)==0){
      return $productID;
    }else{
     return $array[2];
    }
  }else {
    return 'sorry. DataBase is not connection.';
  }
mysql_close($mysqli);

}

function boardPrice($productID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Product Where productID =";
      $sql = $sql.$productID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $productID;
      }else{
       return $array[4];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function boardNum($category){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
  //    $sql = "SELECT * from Product";
      $sql = "SELECT * from Product Where category =";
      $sql = $sql.$category;

      $result = mysqli_query($mysqli,$sql);
      if(mysqli_num_rows($result)==0){
        return 0;
      }else{
        return mysqli_num_rows($result);
      }
  }
  else{
      return 'sorry. DataBase is not connection.';
  }
  mysql_close($mysqli);
}

function getdetailimage($productID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Product Where productID =";
      $sql = $sql.$productID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $productID;
      }else{
       return $array[6];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function getthumbnail($productID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from Product Where productID =";
      $sql = $sql.$productID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $productID;
      }else{
       return $array[5];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

 ?>
