<div id="topnav_login">
    <div class="container">
  <br>
  <div class="nav_menu" style="text-align:right">

    <div id="top-nav">
      <ul>
        <li><a href="../member/logout.php">로그아웃</a></li>
        <li><a href="../messenger/messenger.php">메시지</a></li>
        <li><a href="../wishlist/wishlist.php">장바구니</a></li>
        <li><a href="../shoplist/shoplist.php">주문조회</a></li>
        <?php
            include '../../control/controller.php';

            if(checkType()==true){
              // /          echo "<div id=\"topnav_login\"></div>";
              echo "<li><a href=\"/register/register.php\">상품등록</li>";
            }
            //echo "<td><input type='button' value='LOGIN' class='topbutton' onclick=\"location.href='".$URL."';\">";
        ?>
        <li><a href="../myshop/myshop.php">마이페이지</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
