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
            <h4>재료 수정 완료</h4>

            <?php
                //editMaterialForm.php에서 POST 방식으로 넘어온 값 저장 및 출력
                $materialID = $_POST["materialID"];
                $materialName = $_POST["materialName"];
                $material_Quantity = $_POST["material_Quantity"];
                $matURL = $_POST["matURL"];

                echo "materialID : " . $materialID . "<br>";
                echo "materialName : " . $materialName . "<br>";
                echo "material_Quantity : " . $material_Quantity . "<br>";
                echo "matURL : " . $matURL . "<br>";


                //커넥션 객체 생성 및 연결 여부 확인하기
                $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
                $mysqli->set_charset('utf8');
                if($mysqli) {
                    echo "연결 성공<br>";
                } else {
                    die("연결 실패 : " .mysqli_error());
                }
                //material 테이블의 materialID값이 일치하는 행의 수정 값을 입력한 값으로 수정하는 쿼리
                $sql = "UPDATE Material SET materialID=".$materialID.",materialName='".$materialName."',material_Quantity=".$material_Quantity.",matURL='".$matURL."' WHERE materialID=".$materialID."";
                $result = mysqli_query($mysqli,$sql);
                //수정 작업의 성공 여부 확인하기
                if($result) {
                    echo "수정 성공: ".$result;
                } else {
                    echo "수정 실패: ".mysqli_error($mysqli);
                }

                mysql_close($mysqli);

                //헤더를 이용한 리다이렉션 구현
                header("Location: https://upcyclothes.duckdns.org/admin/materialManaging.php");

            ?>


          </div>
        </div>
      </div>
    </div>

</body>
</html>
