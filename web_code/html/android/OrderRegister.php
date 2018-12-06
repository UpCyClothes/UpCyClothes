<?php
    header('Content-Type: text/html; charset=utf-8');


    $connect=mysqli_connect( "localhost", "root", "316011", "upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
   $connect->set_charset('utf8');

    session_start();

   $productID = $_POST['productID'];
   $userID = $_POST['userID'];
   $receiverName = $_POST['receiverName'];
   $receiverAddress1 = $_POST['receiverAddress1'];
   $receiverAddress2 = $_POST['receiverAddress2'];
   $receiverZipcode = $_POST['receiverZipcode'];
   $receiverRequirement = $_POST['receiverRequirement'];
   $receiverTel = $_POST['receiverTel'];
   $quantity = $_POST['quantity'];
   $date = $_POST['date'];
   $totalprice = $_POST['totalprice'];
   $orderState = $_POST['orderState'];
   $itemType = $_POST['itemType'];
   $itemList= $_POST['itemList'];
   $quantityList= $_POST['quantityList'];
   $cartIDList=$_POST['cartID'];

//카트아이디로 잘라서 장바구니에서 삭제

      //echo $cartIDList;
    $cartID=explode(':',$cartIDList);
    $num_list=count($cartID);
    for ($j=0; $j < $num_list; $j++)
    {
        $q2 = "DELETE FROM Mycart WHERE mycartID=$cartID[$j]";
        $result2 = mysqli_query($connect, $q2);
        //echo $cartID[$j];
    }

   $sql = "INSERT INTO orderList VALUES (null, '{$productID}','{$userID}','{$receiverName}','{$receiverAddress1}',
     '{$receiverAddress2}','{$receiverZipcode}','{$receiverRequirement}','{$receiverTel}','{$quantity}','{$date}','{$totalprice}','{$orderState}','{$itemType}','{$itemList}','{$quantityList}')"; //////////////////sql for modify

   $result = mysqli_query( $connect, $sql);


   $response = array();
   $response["success"]=true;
   echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);

?>
