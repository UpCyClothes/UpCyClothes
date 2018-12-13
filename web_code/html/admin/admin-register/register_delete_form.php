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
        <h4>등록 대기 상품</h4>

        <?php
            //productManaging.php 페이지에서 넘어온 글 번호값 저장 및 출력
            $ID = $_GET["ID"];
            echo $ID."번째 등록 대기 상품 삭제 페이지<br>";
        ?>

        <!-- board_delete_action.php 페이지로 post방식을 이용하여 값 전송 -->
        <form action="./deleteAction.php" method="post">
            <table class="table table-bordered" style="width:10%">
                <tr>
                    <td>관리자 비밀 번호를 입력하세요.</td>
                </tr>
                <tr>
                    <td><input type="text" name="admin_pw">
                        <input type="hidden" name="ID" value="<?php echo $ID?>">
                    </td>
                </tr>
                <tr>
                    <td><button class="btn btn-primary" type="submit">상품 삭제 버튼</td>
                </tr>
            </table>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
