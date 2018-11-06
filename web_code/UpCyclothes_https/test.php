<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="designer-style.css">
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
      include '../../../control/material-controller.php';

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
  $name = getdetailname($p_id);
  $url = getdetailurl($p_id);
  $num = getdetailnum($p_id);
  $url = "..".$url;

  #Image 띄우기
  echo "<div class=\"row\">";
  echo "<div class=\"col-md-4\"  style=\"text-align:center; margin-left:100px\">";
  echo "<img class=\"img-member\" src=\"$url\" style=\"width : 350px; height : 350px\">";
  echo "</div>";

  #Detail-Discription
  echo "<div class=\"col-md-5\">";
  echo "<h4><label style=\"font-size:20px\">$name</label></h4>";
  echo "<h5><label style=\"font-size:15px\">$designer</label></h5>";
  echo "<h3><label style=\"font-size:25px\">$price2 원</label></h3>";
  echo "<hr width =100% color=\"#000000\" align=\"left\"/>";  #선그리기
  echo "<p> 남은 수량을 확인하고 주문하시기 바랍니다.</p>";
  echo "<hr width =100% color=\"#000000\" align=\"left\"/>";  #선그리기

  echo "<table>";
  echo "<td class=\"memberinput\" style=\"margin-left:30px;\">";
  echo "<button type=\"button\" onclick=\"downBtn()\" name=\"down\">-</button>";
  echo "<input type=\"hidden\" id=\"originprice\" value=\"$price1\">";
  echo "<input id=\"pnumber\" style=\"width:50px; text-align:center\" value=\"0\" readonly>";
  echo "<button type=\"button\" onclick=\"upBtn()\" name=\"up\">+</button>";
  echo "</td>";
  echo "</table>";

  echo "<div style=\"float:right\">";
  echo "<table>";
  echo "<td>";
  echo "<h5 style=\"float:left; font-size:15px\">총&nbsp</h5>";
  echo "<h5 style=\"float:left; font-size:15px\" type=\"text\" id=\"tPrice\" value=\"0\">0</h5>";
  echo "<h5 style=\"float:left; font-size:15px\">&nbsp원</h5>";
  echo "</td>";
  echo "</table>";
  echo "</div>";

  echo "<br><br>";
  //Button
  echo "<table>";
  echo "<td>";
  echo "<input class=\"btn btn-warning btn-lg\" style=\"margin-right: 10px \" type=\"button\" value=\"장바구니\">";
  echo "<input class=\"btn btn-success btn-lg\" style=\"margin-right: 10px \" type=\"button\" value=\"주문하기\">";
  echo "<input class=\"btn btn-primary btn-lg\"  type=\"button\" value=\"톡톡문의\">";
  echo "</td>";
  echo "</table>";
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

  ?>
  </div>
  <div id="footer"></div>

</body>
</html>
