<!DOCTYPE html>
<html lang="en">
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
    $("#header").load("./admin-header.php")
    $("#nav").load("./admin-nav.php")
  });
</script>

<body>

<div id="header"></div>

<div class="container-fluid">
  <div class="row content">
    <div id="nav"></div>
    <br>

      <div class="col-sm-9">
      <div class="well">
        <h4>전체 주문 현황</h4>
        진행 상태
        <br/>
        <input type="button" value="전체" onclick="alert('hello world')">
        <input type="button" value="주문 접수" onclick="alert('hello world')">
        <input type="button" value="입금 확인" onclick="alert('hello world')">
        <input type="button" value="배송 준비중" onclick="alert('hello world')">
        <input type="button" value="배송 시작" onclick="alert('hello world')">
        <input type="button" value="배송 완료" onclick="alert('hello world')">
        <input type="button" value="주문 취소" onclick="alert('hello world')">
        <br/>
        <input type="button" value="검색" style="WIDTH: 160pt; HEIGHT: 30pt" onclick="alert('hello world')">
        <input type="button" value="초기화" style="WIDTH: 60pt; HEIGHT: 30pt" onclick="alert('hello world')">
      </div>

    <div class="col-sm-15">
      <div class="well">
        <h4>주문목록</h4>

        총 주문 수 :    검색 주문 수 :

        <table class="table table-hover">

              <thead>
                <tr>
                  <th style="width:5%">번호</th>
                  <th style="width:15%">주문일</th>
                  <th style="width:15%">주문번호</th>
                  <th style="width:15%">상품명</th>
                  <th style="width:10%">주문자명</th>
                  <th style="width:10%">주문금액</th>
                  <th style="width:10%">주문상태</th>
                  <th style="width:20%">기능</th>
                </tr>
              </thead>
                <tbody>
                  <!--주문 게시물 php 작성 Part-->
                  <?php

                  $record_per_page = 15;
                  $page_per_block = 10;

                  $now_page = ($_GET['page']) ? $_GET['page'] : 1;
                  // 현재 블럭
                  $now_block = ceil($now_page / $page_per_block);


                  $mysqli = mysqli_connect("localhost", "root", "316011", "upcyclothes_db");
                  $mysqli->set_charset('utf8');

                  $query = "SELECT * from orderList";
                  $result = mysqli_query($mysqli, $query);

                  $totalNum = mysqli_num_rows($result);

                  while($orderArray = mysqli_fetch_array($result)){
                    //mysql_data_seek($result, $i);

                    echo "<tr>";
                    echo "<td>$orderArray[0]</td>";
                    echo "<td>$orderArray[5]</td>";
                    echo "<td>$orderArray[6]</td>";
                    echo "<td>$orderArray[2]</td>";
                    echo "<td>$orderArray[1]</td>";
                    echo "<td>$orderArray[7]</td>";
                    echo "<td>$orderArray[8]</td>";
                    echo "<td><a href='../../../control-admin/order-controller.php?'>수정</a></td>";
                    echo "</tr>";
                    $i = $i + 1;
                  }

                  mysql_close($mysqli);

                  ?>


                </tbody>
            </table>

            <input type="button" value="선택 삭제" onclick="alert('hello world')">
            <input type="button" value="변경" onclick="alert('hello world')">

      </div>
    </div>
  </div>
</div>

</body>
</html>
