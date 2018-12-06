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

            include "../../../../control-admin/order-controller.php";

            getorderstate();

            $row = mysqli_fetch_array($resulttoedit);


              $row["orderID"] = $edit[0];
              $edit[1] = $row["productID"];
              $row["userID"] = $edit[2];
              $row["orderState"] = $edit[3];

        ?>

        <br>
        <form action="./editAction.php" method="post">
           <table class="table table-bordered" style="width:100%">
               <tr>
                   <td style="width:20%">주문번호</td>
                   <td style="width:80%"><input type="text" name="orderID" value="<?php echo $row["orderID"]?>" readonly></td>
               </tr>
               <tr>
                   <td style="width:20%">상품번호</td>
                   <td style="width:80%"><input type="text" name="productID" value="<?php echo $edit[1]?>" readonly></td>
               </tr>
               <tr>
                   <td style="width:20%">주문자ID</td>
                   <td style="width:80%"><input type="text" name="userID" value="<?php echo $edit[2]?>" readonly></td>
               </tr>
               <tr>
                   <td style="width:20%">주문상태</td>
                   <td style="width:80%"><input type="text" name="orderState" value="<?php echo $edit[3]?>"></td>
               </tr>
           </table>
           <br>

           <?php

           echo "&nbsp; &nbsp; &nbsp; &nbsp;";


           ?>

            <input class="btn btn-primary"  type="submit"></input>

            <a class="btn btn-primary" href="./orderManaging.php"> 리스트로 돌아가기</a>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
