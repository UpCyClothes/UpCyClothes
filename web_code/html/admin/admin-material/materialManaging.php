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
                  //mysqli_connect()함수로 커넥션 객체 생성
                  $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
                  $conn->set_charset('utf8');
                  //커넥션 객체 생성 확인
                  if($conn) {
                      echo "연결 성공<br>";
                  } else {
                      die("연결 실패 : " .mysqli_error());
                  }

                  //board 테이블을 조회해서 board_no, board_title, board_user, board_date 필드 값을 내림차순으로 정렬하여 모두 가져 오는 쿼리
                  $sql = "SELECT materialID, materialName, material_Quantity, matURL FROM Material order by materialID";
                  $result = mysqli_query($conn,$sql);
                  //쿼리 조회 결과가 있는지 확인
                  if($result) {
                      echo "조회 성공";
                  } else {
                      echo "결과 없음: ".mysqli_error($conn);
                  }

                  while($row = mysqli_fetch_array($result)){
              ?>
                  <tr>
                      <td>
                          <?php
                              echo $row["materialID"];
                          ?>
                      </td>
                      <td>
                          <?php
                              echo $row["materialName"];
                          ?>
                      </td>
                      <td>
                          <?php
                              echo $row["material_Quantity"];
                          ?>
                      </td>
                      <td>
                          <?php
                              echo $row["matURL"];
                          ?>
                      </td>
                          <?php
                              echo "<td><a href='./material_update_form.php?materialID=".$row["materialID"]."'>수정</a></td>";
                          ?>
                  </tr>
              <?php
                  }

                  ?>

                </tbody>
            </table>

      </div>

    </div>
  </div>
</div>

</body>
</html>
