<?php
header('Content-Type: text/html; charset=utf-8');
    $connect=mysqli_connect( "localhost", "root", "316011" ,"upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
 $connect->set_charset('utf8');

    mysqli_query("set names utf8");

    session_start();

    $cat = $_POST['designerID'];
    $q1 = "SELECT messengerID, readmark  FROM messenger WHERE designerID='".$cat."'";

    $result = mysqli_query($connect, $q1);


  $total_record = mysqli_num_rows($result);

  // ��ȯ�� �� ���ڵ庰�� JSONArray �������� ������.
  for ($i=0; $i < $total_record; $i++)
  {
      // ������ ���ڵ��� ��ġ(������) �̵�
      mysqli_data_seek($result, $i);

      $row = mysqli_fetch_array($result);
      if($row[readmark]==0){
        $response = array();
        $response["success"]=true;
        echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        break;
      }
  }
?>
