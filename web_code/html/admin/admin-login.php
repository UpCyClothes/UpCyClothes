<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upcyclothes Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="./login-style.css">
  </head>
  <body>
    <div id="lcontents">
      <?php
          include '../../../control/controller.php';
          if(checkAdmin()==true){
            echo("<script>location.replace('./admin.php');</script>");
          }
      ?>
      <div class="login-page">
        <div class="form">
          <form class="login-form" method="post" action="./login_ok.php">
            <p>Upcyclothes 관리자 페이지입니다.</p>
            <p>관리자 아이디로 로그인 하세요.</p>
            <input type="text" name="userId" placeholder="아이디" value=""/>
            <input type="password" name="userPassword" placeholder="비밀번호" value=""/>
            <button type="submit">login</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>
