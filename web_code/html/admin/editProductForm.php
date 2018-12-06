<?php
        header('Content-Type: text/html; charset=utf-8');
 ?>
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
    <div class="col-sm-18">
      <div class="well">
        <h4>상품수정</h4>

        <?php

            //커넥션 객체 생성 (데이터 베이스 연결)
            $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $mysqli->set_charset('utf8');
            //연결 성공 여부 확인
            if($mysqli) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            $productID = $_GET["productID"];
            echo $productID."번째 상품 수정 페이지<br>";


            //product 테이블을 조회하여 productID의 값이 일치하는 행의 productID, productName, designer, category, price, URL, content, quantity 필드의 값을 가져오는 쿼리
            $sql = "SELECT productID, productName, designer, category, price, URL, content, quantity FROM Product WHERE productID = '".$productID."'";
            $result = mysqli_query($mysqli,$sql);
            if($row = mysqli_fetch_array($result)){
        ?>

        <br>
        <form action="./product_update_action.php" method="post">
           <table class="table table-bordered" style="width:100%">
               <tr>
                   <td style="width:20%">상품번호</td>
                   <td style="width:80%"><input type="text" name="productID" value="<?php echo $row["productID"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">상품명</td>
                   <td style="width:80%"><input type="text" name="productName" value="<?php echo $row["productName"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">디자이너</td>
                   <td style="width:80%"><input type="text" name="designer" value="<?php echo $row["designer"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">카테고리</td>
                   <td style="width:80%"><input type="text" name="category" value="<?php echo $row["category"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">가격</td>
                   <td style="width:80%"><input type="text" name="price" value="<?php echo $row["price"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">썸네일 이미지</td>
                   <td style="width:80%"><input type="text" name="URL" value="<?php echo $row["URL"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">상세 페이지</td>
                   <td style="width:80%"><input type="text" name="content" value="<?php echo $row["content"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">수량</td>
                   <td style="width:80%"><input type="text" name="quantity" value="<?php echo $row["quantity"]?>"></td>
               </tr>
           </table>
           <br>

           <?php

           echo "&nbsp; &nbsp; &nbsp; &nbsp;";

           }
           //커넥션 객체 종료
           mysqli_close($mysqli);

           ?>

            <input class="btn btn-primary"  type="submit"></input>

            <a class="btn btn-primary" href="productManaging.php"> 리스트로 돌아가기</a>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
