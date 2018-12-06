<?php
    header('Content-Type: text/html; charset=utf-8');


    $connect=mysqli_connect( "localhost", "root", "316011", "upcyclothes_db") or
        die( "SQL server can not connect to SQL server.");
   $connect->set_charset('utf8');

    session_start();

   $productID = $_POST['productID'];
   $user_ID = $_POST['user_ID'];
   $designer = $_POST['designer'];
   $productName = $_POST['productName'];
   $count = $_POST['count'];
   $price = $_POST['price'];
   $productURL = $_POST['productURL'];
   $quantity = $_POST['quantity'];
   $response = array();
//프로덕트아이디랑 유저아이디가 같은게 현재 있으면 받아온 카운트 프라이스  더해서 업데이트
   $q1="SELECT mycartID,count,price FROM Mycart WHERE user_ID='".$user_ID."' AND productID=$productID";
   //echo $q1;
   $result1 = mysqli_query($connect, $q1);
   $total_record = mysqli_num_rows($result1);
   //echo $total_record;
   if($total_record==1){

     $row = mysqli_fetch_array($result1);
     $count_bf=$row[count];
     $price_bf=$row[price];
     $mycartID=$row[mycartID];
    //echo $mycartID;
    //현재 프로덕트의 맥스퀀터티보다 새롭게 더할 것이 크면 안돼!
    if($count+$count_bf>$quantity){
       $response["success"]=2;
    }
    else{
      $sql1 = "UPDATE Mycart SET count=$count+$count_bf,price=$price+$price_bf WHERE mycartID=$mycartID";
      $result2 = mysqli_query( $connect, $sql1);

      $response["success"]=1;
    }
     }
else{
   $sql = "INSERT INTO Mycart VALUES (null, '{$productID}','{$user_ID}','{$designer}','{$productName}','{$count}','{$price}','{$productURL}')"; //////////////////sql for modify
   $result = mysqli_query( $connect, $sql);

   $response["success"]=0;
}


   echo json_encode($response, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);


?>
