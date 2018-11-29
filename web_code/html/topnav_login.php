<div id="topnav_login">
    <div class="container">
  <br>
  <div class="nav_menu" style="text-align:right">

    <div id="top-nav">
      <ul>
        <?php
        include '../../control/controller.php';
        include '../../control/qna-controller.php';
        $userName = getUserName();
        if(checkType()==true){
          $isNew = isNew();
          $isNewQNA = isNewQNA();
          if($isNew==1||$isNewQNA==1){
            echo "<li>$userName 님
            <a href=\"../messenger/messenger.php\">
            <i class=\"icon\">
            <img src=\"../icon-16/new.png\"></i></a></li>";
          }else{
            echo "<li>$userName 님</li>";
          }
        }else{
          $isNew = isNew();
          if($isNew==1){
            echo "<li>$userName 님
            <a href=\"../messenger/messenger.php\">
            <i class=\"icon\">
            <img src=\"../icon-16/new.png\"></i></a></li>";
          }else{
            echo "<li>$userName 님</li>";
          }
        }
        ?>
        <li><a href="../wishlist/wishlist.php">장바구니</a></li>
        <?php
            if(checkType()==true){
              echo "<li><a href=\"/register/register.php\">상품등록</li>";
            }
            //echo "<td><input type='button' value='LOGIN' class='topbutton' onclick=\"location.href='".$URL."';\">";
        ?>
        <li><a href="../myshop/myshop.php">마이페이지</a></li>
        <li><a href="../member/logout.php">로그아웃</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
