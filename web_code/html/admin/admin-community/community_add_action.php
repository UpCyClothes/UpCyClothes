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
            <h4>공지사항 추가 완료</h4>

            <?php
                //addNoticeForm.php 페이지에서 넘어온 글 번호값 저장 및 출력
                $noticeType = $_POST["noticeType"];
                $subject = $_POST["subject"];
                $content = $_POST["content"];
                $updated = date("Ymd");

                echo "noticeType : " . $noticeType . "<br>";
                echo "subject : " . $subject . "<br>";
                echo "content : " . $content . "<br>";
                echo "현재 날짜 : ". date("Ymd")."<br/>";



                //mysql 커넥션 객체 생성
                $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
                $mysqli->set_charset('utf8');
                //커넥션 객체 생성 여부 확인
                if($mysqli) {
                    echo "연결 성공<br>";
                } else {
                    die("연결 실패 : " .mysqli_error());
                }
                //notice 테이블에 입력된 값을 1행에 넣고 updated 필드에는 현재 시간을 입력하는 쿼리
                $sql = "INSERT INTO Notice (noticeType, subject, content, updated) values ('".$noticeType."','".$subject."','".$content."','".$updated."')";
                $result = mysqli_query($mysqli,$sql);
                // 쿼리 실행 여부 확인
                if($result) {
                    echo "입력 성공: ".$result; //과제 작성시 에러메시지 출력하게 만들기
                } else {
                    echo "입력 실패: ".mysqli_error($mysqli);
                }
                mysqli_close($mysqli);
                //헤더함수를 이용하여 리스트 페이지로 리다이렉션
                header("Location: https://upcyclothes.duckdns.org/admin/communityManaging.php"); //헤더 함수를 이용해서 리다이렉션 시킬 수 있다.
            ?>


          </div>
        </div>
      </div>
    </div>

</body>
</html>
