<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="market-style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
      include '../../../control/contents-controller.php';

      if(checkLogin()==true){
        echo "<div id=\"topnav_login\"></div>";
      }else{
        echo "<div id=\"topnav\"></div>";
      }

  ?>

  <div id="header"></div>
  <div class="container">
  <?php
  $p_id = $_GET['id'];
  $name = boardName($p_id);
  $price = boardPrice($p_id);
  $url = getthumbnail($p_id);
  $detail = getdetailimage($p_id);
  $url = "..".$url;
  $detail ="..".$detail;
  echo "<div class=\"row\">";
  echo "<div class=\"col-md-4\"  style=\"text-align:center; margin-left:100px\">";
  echo "<img class=\"img-member\" src=\"$url\" style=\"width : 350px; height : 350px\">";
  echo "</div>";
  echo "<div class=\"col-md-5\">";
  echo "<br><br><br><br>";
  echo "<h3><label for=\"name\" style=\"font-size:20px\">상품명: $name</label></h3>";
  echo "<h3><label for=\"job\" style=\"font-size:20px\">$price 원</label></h3>";
  echo "<p><label for=\"job\">수량: <input type=\"text\" value=\"\"> 개</label></p>";
  echo "<br><br>";
  echo "<input class=\"completebtn1\"  type=\"button\" value=\"주문하기\">";
  echo "<input class=\"completebtn1\"  type=\"button\" value=\"톡톡문의\">";
  echo "</div>";
  echo "</div>";
  echo "<br><br>";
    echo "<div  style=\"text-align:center\">";
  echo "<hr width = \"100%\" style=\"border: solid 1px; color: #808080 \">";
  echo "<h3><label for=\"name\" style=\"font-size:20px\">상세설명</label></h3>";
  echo "<hr width = \"100%\" style=\"border: solid 1px; color: #808080 \">";
  echo "</div>";
  echo "</div>";

  echo "<br><br>";
  echo "<div  style=\"text-align:center\">";
  echo "<img class=\"img-member\" src=\"$detail\" >";
  echo "</div>";

  // echo "<p>$name</p>";
  // echo "<p>$price</p>";
  // echo "<p>$url</p>";
  // echo "<p>$detail</p>";
  ?>
  </div>
  <div id="footer"></div>

</body>
</html>
