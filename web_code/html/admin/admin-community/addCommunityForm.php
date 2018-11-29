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

        <h1 class="display-4">커뮤니티 글 추가</h1>
        <!-- notice_add_action.php로 넘기는 폼 -->
        <form class="form-horizontal" action="community_add_action.php" method="post">

            <div class="form-group">
                <label for="noticeType" class="col-sm-2 control-label">커뮤니티 글 유형 : </label>
                <div class="col-sm-10">
                    <!-- 글 제목 입력 상자 -->
                    <input class="form-control" name="noticeType" id="noticeType" type="text" placeholder="noticeType"/>
                  </div>
            </div>

            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">글 제목 : </label>
                <div class="col-sm-10">
                    <!-- 글 제목 입력 상자 -->
                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Subject"/>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">글 내용 : </label>
                <div class="col-sm-10">
                    <!-- 글 내용 입력 텍스트영역 -->
                    <textarea class="form-control" name="content" id="content" rows="5" cols="50" placeholder="Content"></textarea>
                </div>
            </div>


            <div>
                &nbsp;&nbsp;&nbsp;
                <!-- 글 입력 버튼 -->
                <button class="btn btn-primary" type="submit">글 입력</button>
                &nbsp;&nbsp;
                <!-- 입력 내용 초기화 버튼 -->
                <button class="btn btn-primary" type="reset" value="초기화">초기화</button>
                &nbsp;&nbsp;
                <!-- 리스트로 돌아가는 버튼 -->
                <a class="btn btn-primary" href="./communityManaging.php">리스트로 돌아가기</a>
            </div>
        </form>



      </div>
    </div>
  </div>
</div>

</body>
</html>
