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

      <div class="row">
        <div class="col-sm-12">
          <div class="well">
            <h4>Users</h4>
            <div style="text-align:right">
              <form method=GET name=searchuser action='usercontents-controller.php'>

                <select name="검색유형">
                        <option name="designer" value="{$search_key}">디자이너</option>
                        <option name="consumer">고객</option>
                 </select>
                <input type="submit" value="검색" onclick="searchUser()">
                </div>

              </form>

            <table class="table table-hover">
              <thead>
                <tr>
                  <th style="width:5%">번호</th>
                  <th style="width:10%">아이디</th>
                  <th style="width:10%">이름</th>
                  <th style="width:10%">닉네임</th>
                  <th style="width:15%">연락처</th>
                  <th style="width:20%">메일주소</th>
                  <th style="width:25%">주소</th>
                  <th style="width:5%">유형</th>
                </tr>
              </thead>
                <tbody>
                  <!--user 게시물 php 작성 Part-->
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
                  $sqlCount = "SELECT count(*) FROM user";
                  $resultCount = mysqli_query($mysqli,$sqlCount);
                  if($rowCount = mysqli_fetch_array($resultCount)){
                      $totalRowNum = $rowCount["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
                  }
                  //행 갯수 조회 쿼리가 실행 됐는지 여부
                  if($resultCount) {
                      echo "전체 회원 수 : ". $totalRowNum."<br>";
                  } else {
                      echo "결과 없음: ".mysqli_error($mysqli);
                  }

                  $rowPerPage = 10;   //페이지당 보여줄 게시물 행의 수
                  $begin = ($currentPage -1) * $rowPerPage;
                  //user 테이블을 조회해서 primary_ID, userID, userName, nickname, tel, Email, address1, usertype 필드 값을 primary_ID로 정렬하여 모두 가져 오는 쿼리
                  //입력된 begin값과 rowPerPage 값에 따라 가져오는 행의 시작과 갯수가 달라지는 쿼리
                  $sql = "SELECT primary_ID, userID, userName, nickname, tel, Email, address1, usertype FROM user order by primary_ID desc limit ".$begin.",".$rowPerPage."";
                  $result = mysqli_query($mysqli,$sql);
                  //쿼리 조회 결과가 있는지 확인
                  if($result) {
                      echo "<br>";
                  } else {
                      echo "결과 없음: ".mysqli_error($mysqli);
                  }


                  $record_per_page = 15;
                  $page_per_block = 10;

                  $now_page = ($_GET['page']) ? $_GET['page'] : 1;
                  // 현재 블럭
                  $now_block = ceil($now_page / $page_per_block);



                  while($userArray = mysqli_fetch_array($result)){
                    //mysql_data_seek($result, $i);

                    echo "<tr>";
                    echo "<td>$userArray[0]</td>";
                    echo "<td>$userArray[1]</td>";
                    echo "<td>$userArray[2]</td>";
                    echo "<td>$userArray[3]</td>";
                    echo "<td>$userArray[4]</td>";
                    echo "<td>$userArray[5]</td>";
                    echo "<td>$userArray[6]</td>";
                    echo "<td>$userArray[7]</td>";
                    echo "</tr>";

                  }

                  mysql_close($mysqli);

                  ?>

                </tbody>
            </table>

            <?php
            //currentPage 변수가 1보다 클때만 이전 버튼이 활성화 되도록 함
            if($currentPage > 1 ) {
              //이전 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 뺀 값이 넘어가도록 함
              echo "<a class='btn btn-primary' href ='../admin/userManaging.php?currentPage=".($currentPage-1)."'>이전</a>";
              echo "&nbsp; &nbsp; &nbsp; &nbsp;";
            }

            $lastPage = ($totalRowNum-1) / $rowPerPage;

            if (($totalRowNum-1) % $rowPerPage !=0) {
              $lastPage += 1;
            }
            //lastPage변수가 currentPage 변수보다 클때만 다음 버튼이 활성화 되도록 함
            if($currentPage < $lastPage) {
              //다음 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 더한 값이 넘어가도록 함
              echo "<a class='btn btn-primary' href='../admin/userManaging.php?currentPage=".($currentPage+1)."'>다음</a>";
            }

            echo "<br><br><br>";

              mysql_close($mysqli);
             ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
