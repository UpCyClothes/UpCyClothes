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

  <?php
    include '../../../../control/controller.php';
    if(checkAdmin()==false){
      echo("<script>location.replace('../admin-login.php');</script>");
    }
?>

<div id="header"></div>


<div class="container-fluid">
  <div class="row content">
    <div id="nav"></div>
    <br>

      <div class="col-sm-9">
      <div class="well">

      </div>

    <div class="col-sm-18">
      <div class="well">
        <h4>상품목록</h4>

        <table class="table table-hover">

              <thead>
                <tr>
                  <th style="width:5%">번호</th>
                  <th style="width:30%">상품이름</th>
                  <th style="width:10%">디자이너</th>
                  <th style="width:10%">카테고리</th>
                  <th style="width:10%">판매가</th>
                  <th style="width:10%">이미지</th>
                  <th style="width:10%">상세이미지</th>
                  <th style="width:5%">수량</th>
                  <th style="width:5%">기능</th>
                  <th style="width:5%"></th>
                </tr>
              </thead>
                <tbody>


                  <!--상품 게시물 php 작성 Part-->
                  <?php
                  include '../../../../control-admin/product-controller.php';

                  while($productArray = mysqli_fetch_array($result)){

                    echo "<tr>";
                    echo "<td>$productArray[0]</td>";
                    echo "<td>$productArray[1]</td>";
                    echo "<td>$productArray[2]</td>";
                    echo "<td>$productArray[3]</td>";
                    echo "<td>$productArray[4]</td>";
                    echo "<td>$productArray[5]</td>";
                    echo "<td>$productArray[6]</td>";
                    echo "<td>$productArray[7]</td>";
                    echo "<td><a href='./editProductForm.php?productID=$productArray[0]'>수정</a></td>";
                    echo "<td><a href='./deleteProductForm.php?productID=$productArray[0]'>삭제</a></td>";
                    echo "</tr>";

                  }

                  ?>


                </tbody>

            </table>

            <?php
            //currentPage 변수가 1보다 클때만 이전 버튼이 활성화 되도록 함
            if($currentPage > 1 ) {
              //이전 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 뺀 값이 넘어가도록 함
              echo "<a class='btn btn-primary' href ='../../admin/admin-product/productManaging.php?currentPage=".($currentPage-1)."'>이전</a>";
              echo "&nbsp; &nbsp; &nbsp; &nbsp;";
            }

            $lastPage = ($totalRowNum-1) / $rowPerPage;

            if (($totalRowNum-1) % $rowPerPage !=0) {
              $lastPage += 1;
            }
            //lastPage변수가 currentPage 변수보다 클때만 다음 버튼이 활성화 되도록 함
            if($currentPage < $lastPage) {
              //다음 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 더한 값이 넘어가도록 함
              echo "<a class='btn btn-primary' href='../../admin/admin-product/productManaging.php?currentPage=".($currentPage+1)."'>다음</a>";
            }

            echo "<br><br><br>";

              mysql_close($mysqli);
             ?>



      </div>
    </div>
  </div>
</div>

</body>
</html>
