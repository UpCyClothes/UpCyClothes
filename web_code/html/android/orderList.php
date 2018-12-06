<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['user_ID'];
    $q1 = "SELECT * FROM orderList WHERE userID='".$cat."'";
    $result = mysqli_query($connect, $q1);


  $total_record = mysqli_num_rows($result);
  echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      $productID= $row[productID];
      if($productID==-1){
        //프로덕트가 2개이상일 경우에 모든 프로덕트에 대해 네임을 찾는다.
        $productID=$row[itemList];
        $productIDList=explode(':',$productID);
        $num_list=count($productIDList);
        $productNames="";
        for ($j=0; $j < $num_list; $j++)
        {

        $q2 = "SELECT productName FROM Product WHERE productID=$productIDList[$j]";
        $result2 = mysqli_query($connect, $q2);
        $row1 =mysqli_fetch_array($result2);
        $productNames.=$row1[productName].":";

      }
      $quantity=$row[quantityList];
    }
      else{
      $type =$row[itemType];
      if($type==1){
        $q2 = "SELECT materialName FROM Material WHERE materialID=$productID";
        $result2 = mysqli_query($connect, $q2);
        $row2 =mysqli_fetch_array($result2);
        $productNames=$row2[materialName];
      }
      else{
      $q2 = "SELECT productName FROM Product WHERE productID=$productID";
      $result2 = mysqli_query($connect, $q2);
      $row2 =mysqli_fetch_array($result2);
      $productNames=$row2[productName];
    }
    $quantity=$row[quantity];
  }
      echo "{\"orderID\":\"$row[orderID]\",\"productName\":\"$productNames\",\"receiverName\":\"$row[receiverName]\"
        ,\"receiverAddress1\":\"$row[receiverAddress1]\",\"receiverAddress2\":\"$row[receiverAddress2]\"
        ,\"receiverTel\":\"$row[receiverTel]\",\"quantity\":\"$quantity\",\"date\":\"$row[date]\",\"totalprice\":\"$row[totalprice]\"
        ,\"orderState\":\"$row[orderState]\"}";

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
