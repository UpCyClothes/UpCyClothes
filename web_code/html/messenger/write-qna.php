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
        echo("<script>location.replace('../member/login.php');</script>");
        echo "<div id=\"topnav\"></div>";
      }
  ?>
  <div id="header"></div>

  <div class="container">

     <script type="text/javascript">
       $(document).ready(function(){
         $("#subnav").load("../mypage-sub-nav.php")
       });

       function checkVaildInput(){
         var writeform = document.item;
         if (writeform.qtitle.value== ""||writeform.qcontents.value == ""){
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
           <span>1:1 문의하기</span>
       </div>
         <!-- 주문 상품이 없다면? -->
           <?php
           //productID, date, title, content,userID, designerID
               include '../../../control/contents-controller.php';
               $p_id = $_GET['id'];
               $name = boardName($p_id);
               $price1 = boardPrice($p_id);
               $price2 = number_format($price1);
               $url = getthumbnail($p_id);
               $designer = writerName($p_id);
               $url = "..".$url;

               echo "<div class=\"col-md-4\"  style=\"text-align:center; margin-left:50px; margin-top:10px\">";
               echo "<img class=\"img-member\" src=\"$url\" style=\"width : 200px; height : 200px\">";
               echo "</div>";
               echo "<h4><label style=\"font-size:20px;margin-top:70px\">$name</label></h4>";
               echo "<h5><label style=\"font-size:15px;margin-top:10px\">$designer</label></h5>";
               echo "<br><hr width =100% style = \"margin-top: 50px;\" color=\"#000000\" align=\"left\"/>";  #선그리기

               echo "<form name=\"item\" class=\"write-qna\" onsubmit=\"return checkVaildInput();\"  action=\"qnaController.php\" method=\"post\" style=\"margin-left:100px\">";
               echo "<input type=\"hidden\" name=\"designer\" value=\"$designer\">";
               echo "<input type=\"hidden\" name=\"productID\" value=\"$p_id\">";
               echo "<table class=\"qna-table\">";
               echo "<tr>";
               echo "<td align=left>문의 제목&nbsp;</td>";
               echo "<td align=left><input name=\"qtitle\" type=text name=title style=\"width:100%\" maxlength=30> </td>";
               echo "</tr>";
               echo "<tr>";
               echo "<td align=left >문의 내용&nbsp;</td>";
               echo "<td align=left>";
               echo "<textarea name=\"qcontents\"name=content cols=65 rows=15></textarea>";
               echo "</td>";
               echo "</tr>";
               echo "<tr>";
               echo "<td colspan=10 align=center>";
               echo "<input class=\"btn btn-warning btn\"  type=submit value=\"문의 등록\">";
               echo "&nbsp;&nbsp;";
               echo "<input class=\"btn btn-success btn\" type=button value=\"등록 취소\" onclick=\"history.back(-1)\">";
               echo "</td>";
               echo "</tr>";
            ?>
              </table>
              <br><br>
              </form>
     </div>
   </div>

   <div id="footer"></div>

</body>
</html>
