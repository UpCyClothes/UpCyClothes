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
        <h4>material</h4>
        <?php
            //커넥션 객체 생성 (데이터 베이스 연결)
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $conn->set_charset('utf8');
            //연결 성공 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            $materialID = $_GET["materialID"];
            echo $materialID."번째 재료 수정 페이지<br>";
            //board 테이블을 조회하여 board_no의 값이 일치하는 행의 board_no, board_title, board_content, board_user, board_date 필드의 값을 가져오는 쿼리
            $sql = "SELECT materialID, materialName, material_Quantity, matURL FROM Material WHERE materialID = '".$materialID."'";
            $result = mysqli_query($conn,$sql);
            if($row = mysqli_fetch_array($result)){
        ?>
        <br>
        <form action="./material_update_action.php" method="post">
            <table class="table table-bordered" style="width:30%">
                <tr>
                    <td style="width:10%">재료 번호</td>
                    <td style="width:20%"><input type="text" name="materialID" value="<?php echo $row["materialID"]?>" readonly></td>
                </tr>
                <tr>
                    <td style="width:10%">재료명</td>
                    <td style="width:20%"><input type="text" name="materialName" value="<?php echo $row["materialName"]?>" readonly></td>
                </tr>
                <tr>
                    <td style="width:10%">수량</td>
                    <td style="width:20%"><input type="text" name="material_Quantity" value="<?php echo $row["material_Quantity"]?>"></td>
                </tr>
                <tr>
                    <td style="width:10%">이미지</td>
                    <td style="width:20%"><input type="text" name="matURL" value="<?php echo $row["matURL"]?>"></td>
                </tr>
            </table>
            <br>
        <?php
            }
            //커넥션 객체 종료
            mysqli_close($conn);
        ?>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary" type="submit">글 수정</button>
            &nbsp;&nbsp;
            <a class="btn btn-primary" href="./materialManaging.php"> 리스트로 돌아가기</a>
        </form>
        <script type="text/javascript" src="js/bootstrap.js"></script>


      </div>
    </div>
  </div>
</div>

</body>
</html>
