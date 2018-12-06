<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['category'];
    $q1 = "SELECT * FROM Product WHERE category=";
    $q1 = $q1.$cat;
    $result = mysqli_query($connect, $q1);

    //$row =mysqli_fetch_array($result);

    //$response = array();

    // while($row=mysqli_fetch_array($result)){
    //   //print_r($row);
    //   $response[]=$row["productName"];
    //   $response[]=$row["price"];
    //   $response[]=$row["URL"];
    //   //array_push($response, array('productName'=>$row["productName"], 'price'=>$row["price"], 'URL'=>$row["URL"]));
    //
    // }

  //$json = json_encode(($response), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
  //echo $json;
	//echo "{\"status\":\"cloth\",\"memo\":\"Please check your password\"}";

  $total_record = mysqli_num_rows($result);
  echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      echo "{\"productID\":\"$row[productID]\",\"productName\":\"$row[productName]\",\"designer\":\"$row[designer]\",\"price\":\"$row[price]\",\"URL\":\"$row[URL]\",\"content\":\"$row[content]\",\"quantity\":\"$row[quantity]\"}";

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
