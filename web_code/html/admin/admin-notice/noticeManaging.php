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
        <h4>notice</h4>
        <div style="text-align:right">
        <select name="검색 유형" >
                <option value="notice">공지사항</option>
                <option value="faq">FAQ</option>
         </select>
                 <input type="submit" value="검색">
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
                  <!--공지사항 게시물 php 작성 Part-->
                  <?php
                  include '../../../../control-admin/notice-controller.php';


                  while($noticeArray = mysqli_fetch_array($result)){

                    echo "<tr>";
                    echo "<td>$noticeArray[0]</td>";
                    echo "<td>$noticeArray[1]</td>";
                    echo "<td>manager</td>";
                    echo "<td>$noticeArray[2]</td>";
                    echo "<td>$noticeArray[3]</td>";
                    echo "<td><a href='./editNoticeForm.php?noticeID=$noticeArray[0]'>수정</a></td>";
                    echo "<td><a href='./deleteNoticeForm.php?noticeID=$noticeArray[0]'>삭제</a></td>";
                    echo "</tr>";

                  }

                  ?>


                </tbody>
            </table>

            <button type="button" onclick="location.href='./addNoticeForm.php'">공지사항 추가</button>

      </div>
    </div>
  </div>
</div>

</body>
</html>
