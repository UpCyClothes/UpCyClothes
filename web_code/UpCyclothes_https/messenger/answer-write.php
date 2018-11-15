<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="messenger-style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#topnav").load("../topnav.php")
      $("#topnav_login").load("../topnav_login.php")
      $("#header").load("../header.php")
      $("#footer").load("../footer.html")
    });
</script>
</head>
<body>
  <?php
      include '../../../control/controller.php';
      if(checkLogin()==true){
        echo "<div id=\"topnav_login\"></div>";
      }else{
        //로그인 안되있을 시 -> 로그인으로 페이지 이동시키기.
        echo("<script>location.replace('../member/login.php');</script>");
        echo "<div id=\"topnav\"></div>";
      }
  ?>
  <div id="header"></div>
  <div id = contents>
    <div class="container">
      <script type="text/javascript">
        $(document).ready(function(){
          $("#subnav").load("../mypage-sub-nav.php")
          $("#click-before").load("click-before.php")
        });

        function checkVaildInput(){
          var writeform = document.item;
          if (writeform.qcontents.value == ""){
            alert("모든 입력란을 다 채워주세요");
           return false;
          }else{
           return true;
          }
        }

        </script>
      <div id="subnav"></div>

      <div class="alarm-contents">
        <div class="alarm-title">
            <span>1:1 질문 현황</span>
        </div>
          <!-- 주문 상품이 없다면? -->
          <?php
          include '../../../control/qna-controller.php';
          include '../../../control/contents-controller.php';

          $getMID = $_GET['id'];

          $answerArray = array();
          $mIDArray = array();
          $answerArray = getqnaList();
          $mIDArray = getmessengerIDList();
          $repeatNum = sizeof($answerArray);

          if($answerArray!=-1){
            echo "<div class=\"col-sm-4\">";
            $count=0;
            while($repeatNum>0){
              $title = $answerArray[$count];
              $mID = $mIDArray[$count];
              echo "<div class=\"designer-name\">";
              echo "<i class=\"icon\"><img src=\"../icon-64/user.png\"></i>";
              echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./answer-write.php?id=$mID'\">$title</span>";
              echo "</div>";
              $repeatNum = $repeatNum-1;
              $count = $count+1;
            }
            echo "</div>";
            $showPid = getPID($getMID);
            $name = boardName($showPid);
            $url = getthumbnail($showPid);
            $designer = writerName($showPid);
            $url = "..".$url;
            $title = getTitle($getMID);
            $qna = getQNA($getMID);
            $answer =getAnswer($getMID);
            $userID = getUserQNA($getMID);

            if($answer==NULL){
              $answer = "답변 대기중입니다.";
            }

            echo "<div class=\"col-sm-8\">";
            echo "<img src=\"$url\" style=\"width : 150px; height : 150px; margin : 0; padding:10px\">";
            echo "<h4><label style=\"font-size:20px;\">$name</label></h4>";
            //echo "<hr width =100% style = color=\"#000000\" align=\"left\"/>";  #선그리기
            echo "<form name=\"item\" onsubmit=\"return checkVaildInput();\"  action=\"qanAnswerWrite.php\" method=\"post\">";
            echo "<div class=\"read-title\" style=\"text-align:left\">
            <img style=\"margin:0; margin-bottom:8px; margin-top:8px\"src=\"../icon-64/qa.png\">
            <span>&nbsp;$userID 님의 질문입니다.</span>
            </div>";
            echo "<input type=\"hidden\" name=\"messengerID\" value=\"$getMID\">";
            echo "<div class=\"read-qna\" style=\"text-align:left\">$qna</div>";
            echo "<div class=\"answer-title\" style=\"text-align:left\">
            <img style=\"margin:0; margin-bottom:8px; margin-top:8px\"src=\"../icon-64/qa.png\">
            <span>&nbsp;답변 작성</span>
            </div>";
            echo "<textarea name=\"qcontents\" cols=60 rows=10></textarea>";
            echo "<br>";
            echo "<input class=\"btn btn-warning btn\"  type=submit value=\"답변 작성\">";
            echo "</form>";
            echo "</div>";

          }else{
            echo "<div class=\"no-item\">";
            echo "<img src=\"../icon-64/alarm.png\">";
            echo "<p class=\"empty-msg\">질문이 없습니다.</p><br>";
            echo "</div>";
          }
          ?>
      </div>

    </div>
  </div>
  <br>
  <div id="footer"></div>
</body>
</html>
