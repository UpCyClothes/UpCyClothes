<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="notice-style.css">
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
      include '../../../control/board-controller.php';
      if(checkLogin()==true){
        echo "<div id=\"topnav_login\"></div>";
      }else{
        echo "<div id=\"topnav\"></div>";
      }

  ?>

  <div id="header"></div>
  <div class="container">
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../board-sub-nav.php")
      });
      </script>
    <div id="subnav"></div>
    <!-- Contents -->
    <div class="notice-contents">
        <div class="notice-title">
            <span>FAQ</span>
        </div>
        <table>
        <?php
         $p_id = $_GET['id'];
         //Contents 작성 Part
         $title = getBoardTitle($p_id);
         $date =getBoardDate($p_id);
         $contents = getBoardContents($p_id);

         echo "<tr>";
         echo "<td class=\"td-contents\">$title</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td class=\"td-contents\">$date</td>";
         echo "</tr>";
         echo "<tr>";
         echo "<td class=\"td-contents\">$contents</td>";
         echo "</tr>";
        ?>
        </table>
        <div align="center">
          <input type="button" class="btn btn-success" style="margin-top:10px;"value="목록" onclick=" location.href='./faq.php';">
        </div>
    </div>
  <br><br>
    </div>
  <div id="footer"></div>
</body>
</html>
