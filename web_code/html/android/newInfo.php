<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $q1 = "SELECT * FROM NewItem ";
    $result = mysqli_query($connect, $q1);


  $total_record = mysqli_num_rows($result);
  echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      echo  "{\"itemID\":\"$row[itemID]\",\"itemName\":\"$row[itemName]\",\"designer\":\"$row[designer]\",\"price\":\"$row[price]\",\"URL\":\"$row[URL]\",\"content\":\"$row[content]\",\"quantity\":\"$row[quantity]\"}";
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
