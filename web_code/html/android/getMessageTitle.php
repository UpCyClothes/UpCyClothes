<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['userID'];
    $cat2 = $_POST['designerID'];
    $q1 = "SELECT messengerID, messageTitle, readmark  FROM messenger WHERE userID='".$cat."' and designerID='".$cat2."'";
    $result = mysqli_query($connect, $q1);


  $total_record = mysqli_num_rows($result);
  echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      echo "{\"messengerID\":\"$row[messengerID]\",\"messageTitle\":\"$row[messageTitle]\",\"readmark\":\"$row[readmark]\"}";

      // ������ ���ڵ� ������ ,�� ���δ�. �׷��� ������ ������ �Ǵϱ�.
      if($i<$total_record-1){
          echo ",";
      }
  }
  // JSONArray�� ������ �ݱ�
  echo "]}";
  mysqli_free_result($result);
  mysqli_close($connect);
?>
