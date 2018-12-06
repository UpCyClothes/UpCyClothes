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
        <h4>COMMUNITY</h4>
        <div style="text-align:right">
        <select name="검색유형">
                <option value="notice">오늘의 작가</option>
                <option value="faq">캠페인</option>
         </select>
        <input type="button" value="검색" onclick="alert('hello world')">
       </div>
        <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width:5%">번호</th>
                  <th style="width:50%">제목</th>
                  <th style="width:10%">작성자</th>
                  <th style="width:10%">날짜</th>
                  <th style="width:5%">유형</th>
                  <th style="width:10%">기능</th>
                  <th style="width:10%"></th>
                </tr>
              </thead>
                <tbody>
                  <!--커뮤니티 게시물 php 작성 Part-->
                  <?php

                  $currentPage = 1;
                  if (isset($_GET["currentPage"])) {
                      $currentPage = $_GET["currentPage"];
                  }

                  //mysqli_connect()함수로 커넥션 객체 생성
                  $mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
                  $mysqli->set_charset('utf8');
                  //커넥션 객체 생성 확인
                  if($mysqli) {
                      echo "<br>";
                  } else {
                      die("연결 실패 : " .mysqli_error());
                  }

                  //페이징 작업을 위한 테이블 내 전체 행 갯수 조회 쿼리
                  $sqlCount = "SELECT count(*) FROM Notice";
                  $resultCount = mysqli_query($mysqli,$sqlCount);
                  if($rowCount = mysqli_fetch_array($resultCount)){
                      $totalRowNum = $rowCount["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
                  }
                  //행 갯수 조회 쿼리가 실행 됐는지 여부
                  if($resultCount) {
                      echo "전체 공지사항 수 : ". $totalRowNum."<br>";
                  } else {
                      echo "결과 없음: ".mysqli_error($mysqli);
                  }

                  $rowPerPage = 10;   //페이지당 보여줄 게시물 행의 수
                  $begin = ($currentPage -1) * $rowPerPage;
                  //notice 테이블을 조회해서 noticeID, subject, updated, noticeType 필드 값을 카테고리로 정렬하여 모두 가져 오는 쿼리
                  //입력된 begin값과 rowPerPage 값에 따라 가져오는 행의 시작과 갯수가 달라지는 쿼리
                  $sql = "SELECT noticeID, subject, updated, noticeType FROM Notice WHERE noticeType = 3 OR noticeType = 4 order by noticeID desc limit ".$begin.",".$rowPerPage."";
                  $result = mysqli_query($mysqli,$sql);
                  //쿼리 조회 결과가 있는지 확인
                  if($result) {
                      echo "<br>";
                  } else {
                      echo "결과 없음: ".mysqli_error($mysqli);
                  }


                  while($communtiyArray = mysqli_fetch_array($result)){

                    echo "<tr>";
                    echo "<td>$communtiyArray[0]</td>";
                    echo "<td>$communtiyArray[1]</td>";
                    echo "<td>manager</td>";
                    echo "<td>$communtiyArray[2]</td>";
                    echo "<td>$communtiyArray[3]</td>";
                    echo "<td><a href='./editCommunityForm.php?noticeID=$communtiyArray[0]'>수정</a></td>";
                    echo "<td><a href='./deleteCommunityForm.php?noticeID=$communtiyArray[0]'>삭제</a></td>";
                    echo "</tr>";

                  }

                  ?>


                </tbody>
            </table>

              <button type="button" onclick="location.href='./addCommunityForm.php'">커뮤니티 글 추가</button>

      </div>
    </div>
  </div>
</div>

</body>
</html>
