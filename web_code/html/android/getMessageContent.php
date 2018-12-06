<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['messengerID'];
    $q1 = "SELECT productID, messageTitle, messageContent, answer, readmark  FROM messenger WHERE messengerID=$cat";
    $result = mysqli_query($connect, $q1);
    $row = mysqli_fetch_array($result);
    $productID=$row[0];

    $q2 = "SELECT productName, URL FROM Product WHERE productID=$productID";
    $result2=mysqli_query($connect, $q2);
    $row2= mysqli_fetch_array($result2);
    $total_record2 = mysqli_num_rows($result2);
  $total_record = mysqli_num_rows($result);
  if($total_record!=$total_record2){
    echo "Error";
    echo $total_record;
    echo $total_record2;
  }
  echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      echo "{\"productName\":\"$row2[productName]\",\"URL\":\"$row2[URL]\",\"messageTitle\":\"$row[messageTitle]\",\"messageContent\":\"$row[messageContent]\",\"answer\":\"$row[answer]\",\"readmark\":\"$row[readmark]\"}";

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
