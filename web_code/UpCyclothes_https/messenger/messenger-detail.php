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
  <div id="contents">
    <div class="container">
      <script type="text/javascript">
        $(document).ready(function(){
          $("#subnav").load("../mypage-sub-nav.php")
          $("#click-before").load("click-before.php")
        });
        </script>
      <div id="subnav"></div>
      <div class="alarm-contents">
        <div class="alarm-title">
            <span>1:1 질문 현황</span>
        </div>
          <?php
          include '../../../control/qna-controller.php';
          $getDesigner = $_GET['id'];
          $designerArray = array();
          $designerArray = getDesignerNameList();
          $repeatNum = sizeof($designerArray);
          if($designerArray!=-1){
            echo "<div class=\"col-sm-4\">";
            $count=0;
            while($repeatNum>0){
              $designerName = $designerArray[$count];
              echo "<div class=\"designer-name\">";
              echo "<i class=\"icon\"><img src=\"../icon-64/user.png\"></i>";
              echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./messenger-detail.php?id=$designerName'\">$designerName</span>";
              echo "</div>";
              $repeatNum = $repeatNum-1;
              $count = $count+1;
            }
            echo "</div>";
          }
           $messageArray = array();
           $messageIDArray = array();

           $messageArray = getTitleList($getDesigner);
           $messageIDArray = getIDList($getDesigner);

           $titleRepeat = sizeof($messageArray);
           if($messageTitle!=-1){
            echo "<div class=\"col-sm-8\">";
            $titlecount=0;
            while($titleRepeat>0){
                $title = $messageArray[$titlecount];
                $id = $messageIDArray[$titlecount];
                echo "<div class=\"designer-name\">";
                echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./messenger-show.php?id=$id'\">$title</span>";
                echo "</div>";
                $titleRepeat = $titleRepeat-1;
                $titlecount = $titlecount+1;
            }
          echo "</div>";
          }else{
            echo "<div class=\"no-item\">";
            echo "<img src=\"../icon-64/alarm.png\">";
            echo "<p class=\"empty-msg\">최근 1개월 이내의 QNA가 없습니다.</p><br>";
            echo "</div>";
          }
          ?>
      </div>
    </div>
  </div><br>
  <div id="footer"></div>

</body>
</html>
