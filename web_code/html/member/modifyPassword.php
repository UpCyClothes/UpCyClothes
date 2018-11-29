<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../member/member-style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../myshop/new-style.css">
  <script type="text/javascript">
    $(document).ready(function(){
       $("#topnav").load("../topnav.php")
        $("#topnav_login").load("../topnav_login.php")
       $("#header").load("../header.php")
       $("#footer").load("../footer.html")
       $("#subnav").load("../mypage-sub-nav.php")
    });
  </script>
  <script src="/jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
  <script type="text/javascript">
  function checkVaildInput() {
     var addform = document.join;
     if (addform.name.value == ""||addform.tel2.value == "" ||addform.tel3.value == ""
         ||addform.postnum.value == "" || addform.address1.value == ""){
       //1. 필수 정보가 모두 입력되지 않는 경우
       alert("모든 입력란을 다 채워주세요");
       return false;
     }else if(addform.tel3.value.length<4){
        alert("전화번호를 확인해주세요.");
        return false;
      }else{
        return true;
      }
     }
</script>

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
      <div class="container">
      <div id="subnav"></div>
      <div class="my-page-contents">
        <div class="contentstitle">
          <h4>&nbsp;&nbsp;비밀번호 수정</h4>
        </div>



    <script type="text/javascript" src="member.js"></script>
      <form name="join" onsubmit="return checkVaildInput();" action="passwordModifyController.php" method="post">
        <table id="membertable" align="center">

          <tr>
            <td class="info">&nbsp;&nbsp;현재 비밀번호</td>
            <td class="memberinput">
              <input type="password" class="inputinfo2" name="now_password">
            </td>
          </tr>
          <tr>
            <td class="info">&nbsp;&nbsp;새 비밀번호</td>
            <td class="memberinput">
              <input type="password" class="inputinfo2" name="new_password1">
            </td>
          </tr>
          <tr>
            <td class="info">&nbsp;&nbsp;새 비밀번호 확인</td>
            <td class="memberinput">
              <input type="password" class="inputinfo2" name="new_password2">
            </td>
          </tr>
        </table>
        <!-- tag1, tag2 정보 넘기기 -->
        <div id="bottomContents" align="center">
          <input type="submit" class="completebtn1" value="비밀번호수정">
        </div>
      </form>
</div></div></div><br><br>
<div id="footer"></div>
</body>
</html>
