<?php
function isNew(){
  session_start();
  if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
  }
  $readmark = 2;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE userID='".$user_id."' and readmark = $readmark ";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return 1;
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function isNewDesigner($designer){
  session_start();
  if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
  }
  $readmark = 2;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE userID='".$user_id."'"."and designerID='".$designer."'"."and readmark = $readmark";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return 1;
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function isNewQNA(){
  session_start();
  if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
  }

  $readmark = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
    //Designer의 닉네임을 가져와야됨.
      $usernickname = getNickName($user_id);
      $sql = "SELECT * FROM messenger WHERE designerID='".$usernickname."' and readmark = $readmark ";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return 1;
      }
    }else {
      return 'sorry. DataBase is not connection.';
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

function isNewDesignerQNA($mID){
  session_start();
  if(isset($_SESSION['userId'])){
    $user_id = $_SESSION['userId'];
  }

  $readmark = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");

  $designerNickname = getNickName($user_id);

  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE designerID='".$designerNickname."'"."and messengerID='".$mID."'"."and readmark = $readmark";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return 1;
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getUpdateNeed($messengerID){
   //updateNeed값이 만약 0이라면 readMark 값 갱신할필요없고, 2라면 1로 갱신해주기\
   $readmark = -1;
   $resultarray = array();
   $count = 0;
   $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
   $mysqli->set_charset('utf8');
   if($mysqli){
       $q1 = "SELECT readmark FROM messenger WHERE messengerID='".$messengerID."'";
       $result = mysqli_query($mysqli,$q1);
       if(mysqli_num_rows($result)==0){
         $readmark = -1;
       }else{
         while ($row = mysqli_fetch_array($result)){
                $resultarray[] = $row[0];
         }
         $readmark = $resultarray[0];
       }
       if($readmark==2){
         $updateReadMark = "UPDATE messenger SET readmark = 1";
         $updateReadMark = $updateReadMark." WHERE messengerID ='".$messengerID."'";
         $result = mysqli_query($mysqli,$updateReadMark);

       }
         echo("<script>location.replace('../messenger/messenger.php');</script>");
     }else {
       return 'sorry. DataBase is not connection.';
     }

   mysql_close($mysqli);
}

function insertQNA($productID,$messageTitle,$messageContent,$readmark,$userID,$designerID){
  //QNA 내용 삽입
  $messageDate = $messageDate = date("Y-m-d H:i:s");
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  $answer = "";
  if($mysqli){
      $sql = "INSERT INTO messenger VALUES (null, '{$productID}','{$messageDate}','{$messageTitle}','{$messageContent}','{$answer}','{$userID}','{$designerID}','{$readmark}')";
      $result = mysqli_query($mysqli,$sql);
      echo("<script>
      alert('문의가 등록되었습니다.');
      location.replace('../index.php');
      </script>");
  }
  else{
    echo("<script>
    alert('문의가 등록되지 못하였습니다.');
    location.replace('../index.php');
    </script>");
  }
  mysql_close($mysqli);
}

function insertANSWER($mID, $contents){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
    $updateSQL = "UPDATE messenger SET answer ='".$contents."'";
    $updateSQL = $updateSQL.", readmark = 2";
    $updateSQL = $updateSQL." WHERE messengerID ='".$mID."'";
    //echo $updateSQL;
   $result = mysqli_query($mysqli,$updateSQL);

    if($result){
         //회원가입 성공!
         echo("<script>alert('답변이 등록되었습니다.');</script>");
         echo("<script>location.replace('./answer.php');</script>");
      }else{
        echo("<script>alert('정보 변경 실패.');
          history.back();</script>");
      }
  }else{
      return 'sorry. DataBase is not connection.';
  }
}

function getDesignerNameList(){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      session_start();
      if(isset($_SESSION['userId'])){
        $user_id = $_SESSION['userId'];
      }

      $q1 = "SELECT designerID FROM messenger WHERE userID='".$user_id."' GROUP BY designerID ORDER BY messageDate DESC";

      $result = mysqli_query($mysqli,$q1);

      if(mysqli_num_rows($result)==0){
        return -1;
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

function getTitleListJson($designer){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  mysqli_query("set names utf8");
  session_start();
  $user_id = $_SESSION['userId'];

  $q1 = "SELECT messengerID, messageTitle, readmark FROM messenger WHERE userID='".$user_id."' and designerID='".$designer."'";
  $result = mysqli_query($mysqli, $q1);
  $total_record = mysqli_num_rows($result);
  $resultStart= "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
  for ($i=0; $i < $total_record; $i++)
  {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $resultStart=$resultStart."{\"messengerID\":\"$row[messengerID]\",\"messageTitle\":\"$row[messageTitle]\",\"readmark\":\"$row[readmark]\"}";
      if($i<$total_record-1){
          $resultStart=$resultStart.",";
      }
  }
 $resultStart=$resultStart."]}";
 mysqli_free_result($result);
 mysqli_close($connect);
 echo $resultStart;
}

function writeContentsJson($cat){
  $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
  die( "SQL server can not connect to SQL server.");
  $connect->set_charset('utf8');
  mysqli_query("set names utf8");
  session_start();
  $q1 = "SELECT productID, messengerID, userID ,messageTitle, messageContent, answer, readmark  FROM messenger WHERE messengerID='".$cat."'";
  $result = mysqli_query($connect, $q1);
  $row = mysqli_fetch_array($result);
  $productID=$row[0];


  $q2 = "SELECT productName, URL FROM Product WHERE productID=".$productID;
  $result2=mysqli_query($connect, $q2);
  $row2= mysqli_fetch_array($result2);
  $total_record2 = mysqli_num_rows($result2);
  $total_record = mysqli_num_rows($result);

  if($total_record!=$total_record2){
    echo "Error";
  }

  $resultStart = $resultStart."{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  for ($i=0; $i < $total_record; $i++)
  {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $resultStart=$resultStart."{\"productName\":\"$row2[productName]\",\"URL\":\"$row2[URL]\",\"messengerID\":\"$row[messengerID]\",\"userID\":\"$row[userID]\",\"messageTitle\":\"$row[messageTitle]\",\"messageContent\":\"$row[messageContent]\",\"answer\":\"$row[answer]\",\"readmark\":\"$row[readmark]\"}";

      if($i<$total_record-1){
          $resultStart=$resultStart.",";
      }
  }
  $resultStart=$resultStart."]}";
  $resultStart = str_replace(array("\r\n","\r","\n"),'',$resultStart);
  mysqli_free_result($result);
  mysqli_close($connect);
  echo $resultStart;
}

function getDetailContentsJson($cat){
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
    die( "SQL server can not connect to SQL server.");
    $connect->set_charset('utf8');
    mysqli_query("set names utf8");

    $q1 = "SELECT productID, messengerID, messageTitle, messageContent, answer, readmark  FROM messenger WHERE messengerID='".$cat."'";
    $result = mysqli_query($connect, $q1);
    $row = mysqli_fetch_array($result);
    $productID=$row[0];


    $q2 = "SELECT productName, URL FROM Product WHERE productID=".$productID;
    $result2=mysqli_query($connect, $q2);
    $row2= mysqli_fetch_array($result2);
    $total_record2 = mysqli_num_rows($result2);
    $total_record = mysqli_num_rows($result);

    if($total_record!=$total_record2){
      echo "Error";
    }

    $resultStart = $resultStart."{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

    for ($i=0; $i < $total_record; $i++)
    {
        mysqli_data_seek($result, $i);
        $row = mysqli_fetch_array($result);
        $resultStart=$resultStart."{\"productName\":\"$row2[productName]\",\"URL\":\"$row2[URL]\",\"messengerID\":\"$row[messengerID]\",\"messageTitle\":\"$row[messageTitle]\",\"messageContent\":\"$row[messageContent]\",\"answer\":\"$row[answer]\",\"readmark\":\"$row[readmark]\"}";

        if($i<$total_record-1){
            $resultStart=$resultStart.",";
        }
    }
  $resultStart=$resultStart."]}";
  $resultStart = str_replace(array("\r\n","\r","\n"),'',$resultStart);
  mysqli_free_result($result);
  mysqli_close($connect);
  echo $resultStart;
}

function getTitleList($designer){
  $resultarray = array();
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
    session_start();
    if(isset($_SESSION['userId'])){
      $user_id = $_SESSION['userId'];
    }
    $designerNickname = getNickName($designer);
    $q1 = "SELECT messageTitle FROM messenger WHERE designerID='".$designerNickname."'"."and userID='".$user_id."' ORDER BY messageDate DESC";
      $result = mysqli_query($mysqli,$q1);
      if(mysqli_num_rows($result)==0){
        return -1;
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

function getIDList($designer){
  $resultarray = array();
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');

  if($mysqli){
      session_start();
      if(isset($_SESSION['userId'])){
        $user_id = $_SESSION['userId'];
      }
      $designerNickname = getNickName($designer);

      $q1 = "SELECT messengerID FROM messenger WHERE designerID='".$designerNickname."'"."and userID='".$user_id."' ORDER BY messageDate DESC";
      $result = mysqli_query($mysqli,$q1);
      if(mysqli_num_rows($result)==0){
        return -1;
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

function getPID($mID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE messengerID='".$mID."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return $array[1];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getTitle($mID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE messengerID='".$mID."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return $array[3];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getQNA($mID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE messengerID='".$mID."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return $array[4];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getAnswer($mID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE messengerID='".$mID."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return $array[5];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}

function getmessengerIDList(){
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      session_start();
      if(isset($_SESSION['userId'])){
        $user_id = $_SESSION['userId'];
      }
      $designerNickname = getNickName($user_id);
      $q1 = "SELECT messengerID FROM messenger WHERE designerID='".$designerNickname."'";

      $result = mysqli_query($mysqli,$q1);

      if(mysqli_num_rows($result)==0){
        return -1;
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

function getqnaList(){
  //1:1질문현황
  $resultarray = array();
  $count = 0;
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      session_start();
      if(isset($_SESSION['userId'])){
        $user_id = $_SESSION['userId'];
      }
      $designerNickname = getNickName($user_id);
      $q1 = "SELECT messageTitle FROM messenger WHERE designerID='".$designerNickname."'";

      $result = mysqli_query($mysqli,$q1);

      if(mysqli_num_rows($result)==0){
        return -1;
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

function getUserQNA($getMID){
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  if($mysqli){
      $sql = "SELECT * FROM messenger WHERE messengerID='".$getMID."'";
      $result = mysqli_query($mysqli,$sql);
      $array = mysqli_fetch_array($result);
      if(mysqli_num_rows($result)==0){
        return -1;
      }else{
       return $array[6];
      }
    }else {
      return 'sorry. DataBase is not connection.';
    }
    mysql_close($mysqli);
}
 ?>
