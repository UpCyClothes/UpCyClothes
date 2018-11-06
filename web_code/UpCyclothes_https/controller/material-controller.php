<?php
  function getMaterailName(){
    $resultarray = array();
    $count = 0;
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
       $sql = "SELECT materialName from Material";
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

  function getdetailname($id){
    $resultarray = array();
    $count = 0;
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
      $sql = "SELECT * from Material Where materialID =";
      $sql = $sql.$id;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);

    if(mysqli_num_rows($result)==0){
          return "Fail";
        }else{
          return $array[3];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
  }

  function getdetailurl($id){
    $resultarray = array();
    $count = 0;
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
      $sql = "SELECT * from Material Where materialID =";
      $sql = $sql.$id;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);

    if(mysqli_num_rows($result)==0){
          return "Fail";
        }else{
          return $array[4];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
  }

  function getdetailnum($id){
    $resultarray = array();
    $count = 0;
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
      $sql = "SELECT * from Material Where materialID =";
      $sql = $sql.$id;
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);

    if(mysqli_num_rows($result)==0){
          return "Fail";
        }else{
          return $array[1];
        }
    }
    else{
        return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
  }

  function getMaterailURL(){
    $resultarray = array();
    $count = 0;
    $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
    $mysqli->set_charset('utf8');
    if($mysqli){
       $sql = "SELECT matURL from Material";
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

 ?>
