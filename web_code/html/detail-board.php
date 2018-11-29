<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="index-style.css">
  <link rel="stylesheet" href="review-style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#topnav").load("topnav.php")
      $("#topnav_login").load("topnav_login.php")
      $("#header").load("header.php")
      $("#footer").load("footer.html")
    });
</script>
<script type="text/javascript">

  Number.prototype.format = function() {
    if (this == 0) return 0;

    var reg = /(^[+-]?\d+)(\d{3})/;
    var n = (this + '');

    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

    return n;
  };

  function downBtn() {
    var number = document.getElementById("pnumber").value;
    var nowPrice = document.getElementById("originprice").value;
    if (parseInt(number) - 1 < 0) {
      alert("입력 범위를 초과하였습니다.");
    } else {
      var price = parseInt(nowPrice) * (parseInt(number) - 1);

      if (isNaN(price)) {
        document.getElementById("tPrice").innerHTML = "0";
      } else {
        document.getElementById("pnumber").value = (parseInt(number) - 1);
        price = price.format();
        document.getElementById("tPrice").innerHTML = price;
      }
    }

  }

  function upBtn() {
    var number = document.getElementById("pnumber").value;
    var nowPrice = document.getElementById("originprice").value;
    if (parseInt(number) + 1 > 999) {
      alert("입력 범위를 초과하였습니다.");
    } else {
      var price = parseInt(nowPrice) * (parseInt(number) + 1);
      if (isNaN(price)) {
        document.getElementById("tPrice").innerHTML = "0";
      } else {
        document.getElementById("pnumber").value = (parseInt(number) + 1);
        price = price.format();
        document.getElementById("tPrice").innerHTML = price;
      }
    }
    }

  function pop_action($category){
      if($category==1){

        var p_id = document.getElementById("p_id").value;
        var p_number = document.getElementById("pnumber").value;
        var o_price = document.getElementById("originprice").value;
        var userID = document.getElementById("userID").value;
        var designerID = document.getElementById("designerID").value;
        var quantity = document.getElementById("quantity").value;
        p_number = parseInt(p_number);
        quantity = parseInt(quantity);
        if(p_number<=0){
          alert("옵션을 선택하세요!");
        }else if(p_number>quantity){
          alert("주문 수량이 초과되었습니다!");
        }else if(userID==designerID){
      alert("자신의 제품은 장바구니에 추가 할 수 없습니다.");
        }else{
          $.ajax({
            url: 'popController.php',
            type: 'post',
            data: {
              'p_id': p_id,
              'p_number' : p_number,
              'o_price' : o_price
            },
            dataType: 'html',
            success: function(data) {
              if("notlogin"==data){
                    alert("로그인 후 이용바랍니다.");
                    location.replace('./member/login.php');
              }else{
                    alert(data);
              }

            },
            error: function(data) {
              alert("server-error : try again");
            }
          });
        }
      }
    }

  function buy_action(){
    //location.href='../buyitem/buyitem.php?id=$p_id'
    var p_id = document.getElementById("p_id").value;
    var p_number = document.getElementById("pnumber").value;
    var o_price = document.getElementById("originprice").value;
    var userID = document.getElementById("userID").value;
    var designerID = document.getElementById("designerID").value;

    if(p_number<=0){
        alert("옵션을 선택하세요!");
    }else if(p_number>document.getElementById("quantity").value){
      alert("주문 수량이 초과되었습니다!");
    }else if(userID==designerID){
      alert("자신의 제품은 구매할 수 없습니다.");

    }else{
      var url = "./buyitem/buyitem.php?id="+p_id+"&number="+p_number+"&price="+o_price;
      window.location.href = url;
    }
  }

    function question_action(){
      //location.href='../buyitem/buyitem.php?id=$p_id'
      var p_id = document.getElementById("p_id").value;
      var userID = document.getElementById("userID").value;
      var designerID = document.getElementById("designerID").value;

      if(userID==designerID){
        alert("자신의 제품은 문의 할 수 없습니다.");
      }else{

        var url = "../messenger/write-qna.php?id="+p_id;
        window.location.href = url;
      }
    }

</script>
</head>
<body>
  <?php
      include '../../control/controller.php';
      include '../../control/contents-controller.php';
      include '../../control/mycart-controller.php';
      include '../../control/review-controller.php';
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
  $price1 = boardPrice($p_id);
  $price2 = number_format($price1);
  $url = getthumbnail($p_id);
  $designer = writerName($p_id);
  $designerID = getdesignerID($designer);

  $detail = getdetailimage($p_id);
  $url = "..".$url;
  $detail ="..".$detail;
  $quantity = getQuantity($p_id);

  $userID = checkID();

  echo "<input type=\"hidden\" id=\"userID\" value=\"$userID\">";
  echo "<div class=\"row\">";
  echo "<div class=\"col-md-4\"  style=\"text-align:center; margin-left:100px\">";
  echo "<img class=\"img-member\" src=\"$url\" style=\"width : 350px; height : 350px\">";
  echo "</div>";
  echo "<input type=\"hidden\" id=\"p_id\" value=\"$p_id\">";
  echo "<div class=\"col-md-5\">";
  echo "<h4><label style=\"font-size:20px\">$name</label></h4>";

  echo "<input type=\"hidden\" id=\"designerID\" value=\"$designerID\">";

  echo "<h5><label style=\"font-size:15px\">$designer</label></h5>";
  echo "<h3><label style=\"font-size:25px\">$price2 원</label></h3>";
  echo "<hr width =100% color=\"#000000\" align=\"left\"/>";  #선그리기
  echo "<input type=\"hidden\" id=\"quantity\" value=\"$quantity\">";
  if(checkSoldOut($p_id)==1){
    echo "<span> 남은 수량 $quantity</span>";
    echo "<img src=\"../icon-64/soldout.png\" style=\"width : 40px; height : 40px; margin-left:30px;\">";
  }else{
    echo "<p> 남은 수량 $quantity</p>";
  }

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

  echo "<table>";
  echo "<td>";
  echo "<input type=\"hidden\" id=\"productID\" value=\"$p_id\">";
  //남은 수량 파악해서 sold out 뿌려주기.
  if(checkSoldOut($p_id)==1){
    echo "<input class=\"btn btn-primary btn-lg\"  onclick=\"location.href='../messenger/write-qna.php?id=$p_id';\" type=\"button\"  value=\"톡톡문의\">";
  }else{ //buy_action
    echo "<input class=\"btn btn-warning btn-lg\" style=\"margin-right: 10px \" onclick=\"pop_action(1)\" type=\"submit\" value=\"장바구니\">";
    echo "<input class=\"btn btn-success btn-lg\" style=\"margin-right: 10px \" onclick=\"buy_action()\" type=\"button\" value=\"주문하기\">";
    echo "<input class=\"btn btn-primary btn-lg\"  onclick=\"question_action()\" type=\"button\"  value=\"톡톡문의\">";
  }

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

  <div id="review" class="container">
    <div class="review-title">구매 후기</div>

        <?php
        $reviewArray = array();
        $reviewArray = getReviewCount($p_id);
        $repeatNum = sizeof($reviewArray);
        $count=0;
        if($reviewArray[0]==0&&$repeatNum==1){
          echo "<p class=\"empty-msg\">아직 리뷰가 없습니다. 첫 리뷰의 주인공이 되어보세요!</p>";
        }
        else{
          while($repeatNum>0){
            $review_id = $reviewArray[$count];
            $reviewPoint = getReviewPoint($review_id);
            $reviewer = getReviewer($review_id);
            $reviewDate = getReviewDate($review_id);
            $contents = getReviewContents($review_id);
            echo "<div class=\"col-sm-2\">";
            if($reviewPoint==1){
              echo "<img src=\"../icon-64/point1.png\">";
            }else if($reviewPoint==2){
              echo "<img src=\"../icon-64/point2.png\">";
            }else if($reviewPoint==3){
              echo "<img src=\"../icon-64/point3.png\">";
            }else if($reviewPoint==4){
              echo "<img src=\"../icon-64/point4.png\">";
            }else if($reviewPoint==5){
              echo "<img src=\"../icon-64/point5.png\">";
            }else{
              echo "<img src=\"../icon-64/point1.png\">";
            }
            echo "<br>";
            echo $reviewer;
            echo "<br>";
            echo $reviewDate;
            echo "</div>";
            echo "<div class=\"col-sm-8\">$contents</div></br>";
            echo "<hr class=\"review-line\">";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
        }
        ?>

  </div>

  <br><br>
  <div id="footer"></div>

</body>
</html>
