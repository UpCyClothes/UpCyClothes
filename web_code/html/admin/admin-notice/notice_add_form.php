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

        <form class="form-horizontal" action="./notice_add_action.php" method="post">
            <div class="form-group">
                <label for="InputType" class="col-sm-2 control-label">글 유형 : </label>
                <div class="col-sm-10">
                    <!-- 글 유형 입력 상자 -->
                    <input class="form-control" name="noticeType" id="noticeType" type="text" placeholder="noticeType"/>
                </div>
            </div>
            <div class="form-group">
                <label for="InputSubject" class="col-sm-2 control-label">글 제목 : </label>
                <div class="col-sm-10">
                    <!-- 글 제목 입력 상자 -->
                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Title"/>
                </div>
            </div>
            <div class="form-group">
                <label for="InputContent" class="col-sm-2 control-label">글 내용 : </label>
                <div class="col-sm-10">
                    <!-- 글 내용 입력 텍스트영역 -->
                    <input class="form-control" name="content" id="content" type="text" placeholder="content"/>
                    <!-- <textarea class="form-control" name="InputContent" id="content" rows="5" cols="50" placeholder="content"></textarea> -->
                </div>
            </div>
            <div class="form-group">
                <label for="InputImg" class="col-sm-2 control-label">글 이미지 : </label>
                <div class="col-sm-10">
                    <!-- 작성자명 입력 상자 -->
                    <input class="form-control" name="noticeImg" id="noticeImg" type="text" placeholder="noticeImg"/>
                </div>
            </div>

            <div>
                &nbsp;&nbsp;&nbsp;
                <!-- 글 입력 버튼 -->
                <button class="btn btn-primary" type="submit" value="글 입력">글 입력</button>
                &nbsp;&nbsp;
                <!-- 입력 내용 초기화 버튼 -->
                <button class="btn btn-primary" type="reset" value="초기화">초기화</button>
                &nbsp;&nbsp;
                <!-- 리스트로 돌아가는 버튼 -->
                <a class="btn btn-primary" href="./noticeManaging.php">리스트로 돌아가기</a>
            </div>
        </form>
        <script type="text/javascript">

            //id가 XX인 객체에 변화가 생기면 checkXX 함수를 변화된 객체의 값을 매개로 호출
            $("#noticeType").change(function(){
                checkNoticeType($('#noticeType').val());
            });
            $("#subject").change(function(){
                checkSubject($('#subject').val());
            });
            $("#content").change(function(){
                checkContent($('#content').val());
            });

            //입력된 변수의 길이를 참조하여 조건문을 통해 최소 입력 길이 유효성 검사를 하는 함수
            function checkNoticeType(noticeType) {
                if(noticeType.value > 4) {
                    alert("공지유형은 1, 2, 3, 4 중 하나로 입력하시기 바랍니4.");
                    $('#noticeType').value('').focus();
                    return false;
                } else {
                    return true;
                }
            }

            function checkSubject(subject) {
                if(subject.length < 2) {
                    alert('제목은 2자 이상 입력해야 합니다.');
                    $('#subject').val('').focus();

                    return false;
                } else {
                    return true;
                }
            }

            function checkContent(content) {
                if(content.length < 2) {
                    alert('내용은 2자리 이상 입력해야 합니다.');
                    $('#content').val('').focus();
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <script type="text/javascript" src="js/bootstrap.js"></script>


      </div>
    </div>
  </div>
</div>

</body>
</html>
