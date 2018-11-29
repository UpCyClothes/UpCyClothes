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
      <div class="well">
        <h4>REGISTER</h4>

        <?php

          include "../../../../control-admin/register-controller.php";
            //registerManaging.php 페이지에서 넘어온 글 번호값 저장 및 출력

            getproductToRegister();

            echo $ID."번째 대기상품 등록 페이지<br>";
            
            if($row = mysqli_fetch_array($result)){
        ?>
        ?>

        <form action="./registerAction.php" method="post">
           <table class="table table-bordered" style="width:100%">
               <tr>
                   <td style="width:20%">상품번호</td>
                   <td style="width:80%"><input type="text" name="ID" value="<?php echo $row["ID"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">상품명</td>
                   <td style="width:80%"><input type="text" name="Name" value="<?php echo $row["Name"]?>"></td>
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


           ?>

            <input class="btn btn-primary"  type="submit"></input>

            <a class="btn btn-primary" href="./registerManaging.php"> 리스트로 돌아가기</a>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
