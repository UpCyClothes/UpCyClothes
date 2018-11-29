<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['user_ID'];
    $q1 = "SELECT tag1, tag2 FROM user WHERE userID='".$cat."'";
    //echo $q1;
    $result = mysqli_query($connect, $q1);

    $row = mysqli_fetch_array($result);
  //  echo $q1;
    $tag1=$row[0];
    $tag2=$row[1];
    //echo $tag1.$tag2."ㅗ";
    $q2 = "SELECT * FROM NewItem WHERE category=".$tag1;
    $q2= $q2." OR category=".$tag2;
  //  echo $q2;
    $result = mysqli_query($connect, $q2);
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
