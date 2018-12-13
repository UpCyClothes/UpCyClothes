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
        <h4>notice</h4>
        <div style="text-align:right">
          <공지사항 유형>
        1 : 공지사항 /
        2 : FAQ /
        3 : 이 주의 작가 /
        4 : 캠페인
       </div>

       <table class="table table-bordered">
                   <tr>
                       <td>번호</td>
                       <td>제목</td>
                       <td>작성자</td>
                       <td>날짜</td>
                       <td>유형</td>
                       <td>수정</td>
                       <td>삭제</td>
                   </tr>

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
                     $sql = "SELECT * FROM Notice order by noticeID desc limit ".$begin.",".$rowPerPage."";
                     $result = mysqli_query($mysqli,$sql);
                     //쿼리 조회 결과가 있는지 확인
                     if($result) {
                         echo "<br>";
                     } else {
                         echo "결과 없음: ".mysqli_error($mysqli);
                     }


                       //반복문을 이용하여 result 변수에 담긴 값을 row변수에 계속 담아서 row변수의 값을 테이블에 출력한다.
                       while($row = mysqli_fetch_array($result)){
                   ?>
                       <tr>
                           <td>
                               <?php
                                   echo $row["noticeID"];
                               ?>
                           </td>
                           <td>
                               <?php
                                   echo "<a href='./notice_detail.php?noticeID=".$row["noticeID"]."'>";
                                   echo $row["subject"];
                                   echo "</a>";
                               ?>
                           </td>
                           <td>
                               <?php
                                   echo "manager";
                               ?>
                           </td>
                           <td>
                               <?php
                                   echo $row["updated"];
                               ?>
                           </td>
                           <td>
                               <?php
                                   echo $row["noticeType"];
                               ?>
                           </td>
                               <?php
                                   echo "<td><a href='./notice_update_form.php?noticeID=".$row["noticeID"]."'>수정</a></td>";
                                   echo "<td><a href='./notice_delete_form.php?noticeID=".$row["noticeID"]."'>삭제</a></td>";
                               ?>
                       </tr>
                   <?php
                       }
                   ?>
               </table>
               &nbsp;&nbsp;&nbsp;&nbsp;
                      <?php
                          //currentPage 변수가 1보다 클때만 이전 버튼이 활성화 되도록 함
                          if($currentPage > 1 ) {
                              //이전 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 뺀 값이 넘어가도록 함
                              echo "<a class='btn btn-primary' href ='./noticeManaging.php?currentPage=".($currentPage-1)."'>이전</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                          }

                          $lastPage = ($totalRowNum-1) / $rowPerPage;

                          if (($totalRowNum-1) % $rowPerPage !=0) {
                              $lastPage += 1;
                          }
                          //lastPage변수가 currentPage 변수보다 클때만 다음 버튼이 활성화 되도록 함
                          if($currentPage < $lastPage) {
                              //다음 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 더한 값이 넘어가도록 함
                              echo "<a class='btn btn-primary' href='./noticeManaging.php?currentPage=".($currentPage+1)."'>다음</a>";
                          }
                          mysqli_close($conn);
                      ?>
                      &nbsp;&nbsp;
                      <a class="btn btn-primary" href="./notice_add_form.php">글 쓰기</a>
                      <br><br><br><br><br>
                      <script type="text/javascript" src="js/bootstrap.js"></script>

      </div>
    </div>
  </div>
</div>

</body>
</html>
