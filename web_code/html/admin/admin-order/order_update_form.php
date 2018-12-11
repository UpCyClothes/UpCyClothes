<!DOCTYPE html>
<html>
<head>
  <title>UPCYCLOTHES MANAGER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}


    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
  </style>
</head>

<script type="text/javascript">
  $(document).ready(function(){
    $("#header").load("../admin-header.php")
    $("#nav").load("../admin-nav.php")
  });
</script>

<body>

<div id="header"></div>

<div class="container-fluid">
  <div class="row content">
    <div id="nav"></div>
    <br>

    <div class="col-sm-9">
    <div class="col-sm-18">
      <div class="well">
        <h4>주문 상태 수정</h4>

        1 : 주문 접수
        2 : 입금 확인
        3 : 배송 준비중
        4 : 배송 시작
        5 : 배송 완료

        <?php

            $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $mysqli->set_charset('utf8');
            //연결 성공 여부 확인
            if($mysqli) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            $orderID = $_GET["orderID"];
            echo $orderID."번째 주문상태 수정 페이지<br>";

            $sql = "SELECT orderID, productID, userID, orderState FROM orderList WHERE orderID = '".$orderID."'";
            $result = mysqli_query($mysqli,$sql);

        ?>
        <br>
        <form action="./order_update_action.php" method="post">
        <br>
                 <table class="table table-bordered">
            <tr>
                <td>주문번호</td>
                <td>상품번호</td>
                <td>주문자아이디</td>
                <td>주문상태</td>
            </tr>
            <?php
                //반복문을 이용하여 result 변수에 담긴 값을 row변수에 계속 담아서 row변수의 값을 테이블에 출력한다.
                if($row = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td>
                        <input type="text" name="orderID" value="<?php echo $row["orderID"]?>" readonly>
                    </td>
                    <td>
                        <?php
                            echo $row["productID"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $row["userID"];
                        ?>
                    </td>
                    <td>
                      <input type="text" name="orderState" value="<?php echo $row["orderState"]?>">
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>

            <input class="btn btn-primary" href="./order_update_action.php" type="submit"></input>
            <a class="btn btn-primary" href="./orderManaging.php"> 리스트로 돌아가기</a>
        </form>


      </div>
    </div>
  </div>
</div>

</body>
</html>
