<?php
  header("Content-Type: text/html; charset=UTF-8");
  $designerID = $_POST['desingerID'];
  $mysqli = mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db");
  $mysqli->set_charset('utf8');
  mysqli_query("set names utf8");
  session_start();
  $user_id = $_SESSION['userId'];
  $q1 = "SELECT messengerID, messageTitle FROM messenger WHERE userID='".$user_id."' and designerID='".$designerID."'";
  $result = mysqli_query($mysqli, $q1);
  $total_record = mysqli_num_rows($result);
  $resultStart= "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
  for ($i=0; $i < $total_record; $i++)
  {

      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
      $resultStart=$resultStart."{\"messengerID\":\"$row[messengerID]\",\"messageTitle\":\"$row[messageTitle]\"}";
      if($i<$total_record-1){
          $resultStart=$resultStart.",";
      }
  }
 $resultStart=$resultStart."]}";
 mysqli_free_result($result);
 mysqli_close($connect);
 echo $resultStart;
 ?>
