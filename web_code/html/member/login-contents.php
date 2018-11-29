
<div id="lcontents">
  <?php
      include '../../../control/controller.php';
      if(checkLogin()==true){
        echo("<script>location.replace('../index.php');</script>");
      }
  ?>
  <div class="login-page">
    <div class="form">
      <form class="login-form" method="post" action="../member/login_ok.php">
        <input type="text" name="userId" placeholder="아이디" value=""/>
        <input type="password" name="userPassword" placeholder="비밀번호" value=""/>
        <button type="submit">login</button>
        <p class="message">Not registered? <a href="../member/signup.php">Create an account</a></p>
      </form>
    </div>
  </div>
</div>
