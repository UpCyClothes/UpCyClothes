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
        <h4>재료목록</h4>

        <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width:10%">번호</th>
                  <th style="width:40%">재료이름</th>
                  <th style="width:20%">수량</th>
                  <th style="width:25%">이미지</th>
                  <th style="width:15%">기능</th>
                </tr>
              </thead>
                <tbody>
                  <!--재료 게시물 php 작성 Part-->
                  <?php
                  include "../../../../control-admin/material-controller.php";


                  while($matArray = mysqli_fetch_array($result)){

                    echo "<tr>";
                    echo "<td>$matArray[0]</td>";
                    echo "<td>$matArray[3]</td>";
                    echo "<td>$matArray[1]</td>";
                    echo "<td>$matArray[4]</td>";
                    echo "<td><a href='./editMaterialForm.php?materialID=$matArray[0]'>수정</a></td>";
                    echo "</tr>";

                  }

                  mysql_close($mysqli);

                  ?>


                </tbody>
            </table>

      </div>

    </div>
  </div>
</div>

</body>
</html>
