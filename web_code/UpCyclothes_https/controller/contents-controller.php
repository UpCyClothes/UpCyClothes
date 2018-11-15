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

function getQuantity($productID){
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
       return $array[7];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

/* new item list's function */

function getNewProduct(){
  session_start();
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if(isset($_SESSION['userId'])){
    /*Login이 되어있는 상황이라면? -> 사용자 태그와 같은것만 보여주기*/
    $user_id = $_SESSION['userId'];
    if($mysqli){
      /*사용자의 Tag 정보 가져오기*/
      $tag1SQL = "SELECT tag1, tag2 from user Where userID ='".$user_id."'";
      $result1 = mysqli_query($mysqli,$tag1SQL);
      $array1 = mysqli_fetch_array($result1);
      $tag1 = $array1[0];
      $tag2 = $array1[1];
      $getNewItemNumsql = "SELECT itemID from NewItem Where category=".$tag1;
      $getNewItemNumsql = $getNewItemNumsql." OR category =".$tag2;
      $result = mysqli_query($mysqli,$getNewItemNumsql);
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
  }else{
    /*Login이 되어있지 않은 상황이라면? -> 다 보여주기*/
    if($mysqli){
       $getNewItemNumsql = "SELECT itemID from NewItem";
       $result = mysqli_query($mysqli,$getNewItemNumsql);
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
  }
      mysql_close($mysqli);
}

function newBoardName($itemID){
  /*제품 명 Return*/
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from NewItem Where itemID =";
      $sql = $sql.$itemID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $itemID;
      }else{
       return $array[1];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function newBoardPrice($itemID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from NewItem Where itemID =";
      $sql = $sql.$itemID;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return $itemID;
      }else{
       return $array[4];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
  mysql_close($mysqli);
}

function getNewthumbnail($itemID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * from NewItem Where itemID =";
      $sql = $sql.$itemID;
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
