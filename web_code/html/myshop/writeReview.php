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
  <link rel="stylesheet" href="../shoplist/shoplist-style.css">

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
         });

         function checkVaildInput(){
           var addform = document.item;
           if(addform.qcontents.value==""){
             alert("내용을 작성해주세요.");
             return false;
           }else{
             return true;
           }

         }
        </script>

       <div id="subnav"></div>

       <div class="shoplist-contents">
         <div class="shoplist-title">
             <span>리뷰 작성</span>
         </div>
           <!-- 주문 상품이 없다면? -->
             <?php
             //productID, date, title, content,userID, designerID
                 include '../../../control/contents-controller.php';
                 $p_id = $_GET['id'];
                 $order_id =  $_GET['orderid'];
                 $name = boardName($p_id);
                 $url = "..".$url;

                 echo "<form name=\"item\" class=\"write-qna\" onsubmit=\"return checkVaildInput();\"  action=\"reviewWriteController.php\" method=\"post\" style=\"margin-left:100px\">";

                 echo "<table class=\"qna-table\"style=\"border-spacing:50px\">";
                 echo "<tr>";
                 echo "<td align=left style=\"border-right:2px solid #3ac469; \">상품명&nbsp;</td>";
                 echo "<td align=left style=\"margin-left:10px;\">&nbsp;$name</td>";
                 echo "</tr>";
                 echo "<tr >";
                 echo "<td rowspan=\"5\" align=\"left\">평점&nbsp;</td>";
                 echo "<td><input type=\"radio\" name=\"chk_info\" value=\"1\"  checked=\"checked\">&nbsp;<img src=\"../icon-64/point1.png\"></td>";
                 echo "</tr>";

                 echo "<tr><td style=\"margin-left:10px;\"><input type=\"radio\" name=\"chk_info\" value=\"2\">&nbsp;<img src=\"../icon-64/point2.png\"></td></tr>";
                 echo "<tr><td style=\"margin-left:10px;\"><input type=\"radio\" name=\"chk_info\" value=\"3\">&nbsp;<img src=\"../icon-64/point3.png\"></td></tr>";
                 echo "<tr><td style=\"margin-left:10px;\"><input type=\"radio\" name=\"chk_info\" value=\"4\">&nbsp;<img src=\"../icon-64/point4.png\"></td></tr>";
                 echo "<tr><td style=\"margin-left:10px;\"><input type=\"radio\" name=\"chk_info\" value=\"5\">&nbsp;<img src=\"../icon-64/point5.png\"></td></tr>";
                 echo "<tr>";

                 echo "<td align=left >리뷰&nbsp;</td>";
                 echo "<td align=left>";
                 echo "<textarea name=\"qcontents\" cols=65 rows=15></textarea>";
                 echo "</td>";
                 echo "</tr>";
                 echo "<tr>";
                 echo "<td colspan=10 align=center>";
                 echo "<input class=\"btn btn-warning btn\" type=submit value=\"리뷰 등록\">";
                 echo "&nbsp;&nbsp;";
                 echo "<input class=\"btn btn-success btn\" type=button value=\"등록 취소\" onclick=\"history.back(-1)\">";
                 echo "</td>";
                 echo "</tr>";

                 echo "<input type=\"hidden\" name=\"productID\" value=\"$p_id\">";
                 echo "<input type=\"hidden\" name=\"orderID\" value=\"$order_id\">";

              ?>
                </table>
                <br><br>
                </form>
       </div>
     </div>


  </div><br>
  <div id="footer"></div>

</body>
</html>
