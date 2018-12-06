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
  <script type="text/javascript">


  function downBtn() {
    var number = document.getElementById("pnumber").value;
    if (parseInt(number) - 1 < 0) {
      alert("입력 범위를 초과하였습니다.");
    } else {

        document.getElementById("pnumber").value = (parseInt(number) - 1);
        document.getElementById("totalKG").innerHTML = (parseInt(number) - 1);
    }

  }

  function upBtn() {
    var number = document.getElementById("pnumber").value;
    if (parseInt(number) + 1 > 999) {
      alert("입력 범위를 초과하였습니다.");
    } else {
      document.getElementById("pnumber").value = (parseInt(number) + 1);
      document.getElementById("totalKG").innerHTML = (parseInt(number) + 1);
    }
    }

    function pop_action($category){
      if($category==0){
        var popup = document.getElementById("popup");
        popup.style.visibility = "hidden";
      }else if($category==1){
        var popup = document.getElementById("popup");
        popup.style.visibility = "visible";
      }else if($category==2){
        alert("준비중입니다!");
      }
    }

    function buy_action(){
//
      var p_id = document.getElementById("productID").value;
      var p_number = document.getElementById("pnumber").value;
      var quantity = document.getElementById("quantity").value;
      p_number = parseInt(p_number);
      quantity = parseInt(quantity);
    //
    if(p_number<=0){
        alert("옵션을 선택하세요!");
    }else if(p_number>quantity){
      alert("주문 수량이 초과되었습니다!");
    }else{
        var url = "../buyitem/buyitem.php?id="+p_id+"&number="+p_number+"&price=-1";
      window.location.href = url;
    }
  }
  </script>

<!--Login 반드시 시작점에서 Check-->
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
  $quantity = getQuantity($p_id);
  $url = "..".$url;

  echo "<input type=\"hidden\" id=\"productID\" value=\"$p_id\">";
  echo "<input type=\"hidden\" id=\"quantity\" value=\"$quantity\">";

  echo "<div class=\"row\">";
  echo "<div class=\"col-md-4\"  style=\"text-align:center; margin-left:100px\">";
  echo "<img class=\"img-member\" src=\"$url\" style=\"width : 350px; height : 350px\">";
  echo "</div>";
  echo "<br><br>";

# 남은 수량
  echo "<div class=\"col-md-5\">";
  echo "<h4><label style=\"font-size:20px\">$name</label></h4>";
  echo "<h5><label style=\"font-size:20px\">남은 수량 $num KG</label></h5>";
  echo "<hr width =100% color=\"#000000\" align=\"left\"/>";  #선그리기
  echo "<p> 남은 재고를 확인 후 주문해주시기 바랍니다.</p>";
  echo "<hr width =100% color=\"#000000\" align=\"left\"/>";  #선그리기


# +,- 버튼
  echo "<table>";
  echo "<td class=\"memberinput\" style=\"margin-left:30px;\">";
  echo "<button type=\"button\" onclick=\"downBtn()\" name=\"down\">-</button>";
  echo "<input id=\"pnumber\" style=\"width:50px; text-align:center\" value=\"0\" readonly >";
  echo "<button type=\"button\" onclick=\"upBtn()\" name=\"up\">+</button>";
  echo "</td>";
  echo "</table>";

# 총 수량
  echo "<div style=\"float:right\">";
  echo "<table>";
  echo "<td>";
  echo "<h5 style=\"float:left; font-size:15px\">총&nbsp</h5>";
  echo "<h5 style=\"float:left; font-size:15px\" type=\"text\" id=\"totalKG\" value=\"0\">0</h5>";
  echo "<h5 style=\"float:left; font-size:15px\">&nbspKG</h5>";
  echo "</td>";
  echo "</table>";
  echo "</div>";
  echo "<br><br>";
  echo "<table>";
  echo "<td>";
  echo "<input class=\"btn btn-success btn-lg\" style=\"margin-right: 10px \"onclick=\"buy_action()\" type=\"button\" value=\"주문하기\">";
  echo "</td>";
  echo "</table>";

  echo "</div>";
  echo "</div>";

  ?>

  <br><br>

  <div id="footer"></div>

</body>
</html>
