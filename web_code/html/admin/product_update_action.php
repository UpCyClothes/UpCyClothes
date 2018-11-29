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
            <h4>상품 수정 완료</h4>

            <?php

                //editProductForm.php에서 POST 방식으로 넘어온 값 저장 및 출력
                $productID = $_POST["productID"];
                $productName = $_POST["productName"];
                $designer = $_POST["designer"];
                $category = $_POST["category"];
                $price = $_POST["price"];
                $URL = $_POST["URL"];
                $content = $_POST["content"];
                $quantity = $_POST["quantity"];
                echo "productID : " . $productID . "<br>";
                echo "productName : " . $productName . "<br>";
                echo "designer : " . $designer . "<br>";
                echo "category : " . $category . "<br>";
                echo "price : " . $price . "<br>";
                echo "URL : " . $URL . "<br>";
                echo "content : " . $content . "<br>";
                echo "quantity : " . $quantity . "<br>";

                //커넥션 객체 생성 및 연결 여부 확인하기
                $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
                $mysqli->set_charset('utf8');
                if($mysqli) {
                    echo "연결 성공<br>";
                } else {
                    die("연결 실패 : " .mysqli_error());
                }
                //product 테이블의 productID값이 일치하는 행의 수정 값을 입력한 값으로,board_date값을 현재 시간으로 수정하는 쿼리
                $sql = "UPDATE Product SET productName='".$productName."', designer='".$designer."', category=".$category.", price=".$price.", URL='".$URL."',content='".$content."', quantity=".$quantity." WHERE productID=".$productID;
                echo $sql;
                $result = mysqli_query($mysqli,$sql);
                //수정 작업의 성공 여부 확인하기
                if($result) {
                    echo "수정 성공: ".$result;
                } else {
                    echo "수정 실패: ".mysqli_error($mysqli);
                }

                mysqli_close($mysqli);

            ?>


          </div>
        </div>
      </div>
    </div>

</body>
</html>
