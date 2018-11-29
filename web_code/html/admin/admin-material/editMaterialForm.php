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
        <h4>재료 수정</h4>

        <?php
         include '../../../../control-admin/material-controller.php';

         getmaterialtoEdit();

         if($row=mysqli_fetch_array($result)){
        ?>

        <br>
        <form action='./editAction.php' method="post">
           <table class="table table-bordered" style="width:100%">
               <tr>
                   <td style="width:20%">재료번호</td>
                   <td style="width:80%"><input type="text" name="materialID" value="<?php echo $row["materialID"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">재료명</td>
                   <td style="width:80%"><input type="text" name="materialName" value="<?php echo $row["materialName"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">수량</td>
                   <td style="width:80%"><input type="text" name="material_Quantity" value="<?php echo $row["material_Quantity"]?>"></td>
               </tr>
               <tr>
                   <td style="width:20%">재료 썸네일</td>
                   <td style="width:80%"><input type="text" name="matURL" value="<?php echo $row["matURL"]?>"></td>
               </tr>
           </table>
           <br>

           <?php

           echo "&nbsp; &nbsp; &nbsp; &nbsp;";

           }

           ?>

            <button class="btn btn-primary" type="submit">상품 수정</button>

            <a class="btn btn-primary" href="./materialManaging.php"> 리스트로 돌아가기</a>
        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
