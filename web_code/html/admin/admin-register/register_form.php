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
        <h4>등록대기상품</h4>
        1: /image/clothes / 2: /image/bags / 3: /image/accesories /4: /image/shoes /5:  /image/jewerly
        <?php
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $conn->set_charset('utf8');
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            //notice_list.php 에서 넘어온 글 번호 저장 및 출력
            $ID = $_GET["ID"];
            echo $ID."번 등록 대기 상품 내용<br>";
            //board 테이블에서 board_no값이 일치하는 board_no, board_title, board_content, board_user, board_date 필드 값 조회 쿼리
            $sql = "SELECT * FROM tempDB WHERE ID = '".$ID."'";
            $result = mysqli_query($conn,$sql);
            //조회 성공 여부 확인
            if($result) {
                echo "조회 성공";
            } else {
                echo "결과 없음: ".mysqli_error($conn);
            }
        ?>
        <form action="./register_action.php" method="post">
        <table class="table table-bordered" style="width:100%">
            <?php
                //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
                if($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td style="width:10%">상품ID</td>
                <td style="width:90%">
                    <input type="text" name="ID" value="<?php echo $row["ID"]?>" readonly></td>
                </td>
            </tr>
            <tr>
                <td style="width:10%">상품이름</td>
                <td style="width:90%">
                  <input type="text" name="Name" value="<?php echo $row["Name"]?>" readonly></td>
                </td>
              </tr>
              <tr>
                <td  style="width:10%">디자이너</td>
                <td  style="width:90%">
                  <input type="text" name="designer" value="<?php echo $row["designer"]?>" readonly></td>
                </td>
              </tr>
              <tr>
                <td  style="width:10%">카테고리</td>
                <td  style="width:90%">
                <input type="text" name="category" value="<?php echo $row["category"]?>" readonly></td>
                </td>
              </tr>
              <tr>
                <td  style="width:10%">판매가</td>
                <td  style="width:90%">
                <input type="text" name="price" value="<?php echo $row["price"]?>" readonly></td>
                </td>
              </tr>
              <input type="hidden" name="originURL" value="<?php echo $row["URL"]?>">
              <tr>
                <td  style="width:10%">이미지</td>
                <td  style="width:90%">
                <input type="text" name="URL" value="<?php echo $row["URL"]?>"></td>

                </td>
              </tr>
              <tr>
                <td  style="width:10%">상세이미지</td>
                <td  style="width:90%">
                <input type="text" name="content" value="<?php echo $row["content"]?>"></td>
                  <input type="hidden" name="opriginalcontentURL" value="<?php echo $row["content"]?>">
                </td>
              </tr>
              <tr>
                <td  style="width:10%">수량</td>
                <td  style="width:90%">
                <input type="text" name="quantity" value="<?php echo $row["quantity"]?>" readonly></td>
                </td>
              </tr>

            <?php
                }
            ?>
        </table>
        <br>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" type="submit">등록</button>
        &nbsp;&nbsp;
        <a class="btn btn-primary" href="./registerManaging.php"> 리스트로 돌아가기</a>
        <script type="text/javascript" src="js/bootstrap.js"></script>

        </form>

      </div>
    </div>
  </div>
</div>

</body>
</html>
