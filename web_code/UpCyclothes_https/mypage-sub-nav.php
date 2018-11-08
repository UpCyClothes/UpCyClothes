<aside class="sidenav" style="float:left">
  <div class="side-nav-title">
    <i>MY MENU</i>
  </div>
  <div class="side-nav-div">
    <!--주문 사이드 메뉴-->
    <br>
      <b class="side-nav-b">
        <i class="icon"><img src="../icon-16/shoplist.png" alt=""> </i>
        <span>&nbsp;주문 배송</span>
      </b>
      <br>
      <div class="nav-submenu">
        <a class="sub-a-tag" href="../shoplist/shoplist.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주문내역</a><br>
      </div>
      <!--inline-->
      <hr class="side-nav-line">

      <!--알림 및 공지사항 사이드 메뉴-->

      <b class="side-nav-b">
        <i class="icon"><img src="../icon-16/alarm.png" alt=""> </i>
        <span>&nbsp;알림 및 공지</span>
      </b>
      <br>
      <div class="nav-submenu">
        <a class="sub-a-tag" href="../messenger/messenger.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;메시지</a>
      </div>
      <div class="nav-submenu">
        <a class="sub-a-tag" href="../notice/notice.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;공지사항</a>
      </div>
      <!--inline-->
      <hr class="side-nav-line">
      <!--관심 리스트 사이드 메뉴-->

      <b class="side-nav-b">
        <i class="icon"><img src="../icon-16/wishlist.png" alt=""> </i>
        <span>&nbsp;관심리스트</span>
      </b>
      <br>
      <div class="nav-submenu">
        <a class="sub-a-tag" href="../wishlist/wishlist.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;장바구니</a>
      </div>
      <!--inline-->
      <hr class="side-nav-line">
      <!--회원 정보 사이드 메뉴-->

      <b class="side-nav-b">
        <i class="icon"><img src="../icon-16/user.png" alt=""> </i>
        <span>&nbsp;내 정보</span>
      </b>
      <div class="nav-submenu">
        <a class="sub-a-tag" href="../member/modify.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;주소록(배송지)수정</a>
      </div>
      <?php
      include '../../control/controller.php';

      if(checkType()==true){
        echo "<div class=\"nav-submenu\">";
        echo "<a class=\"sub-a-tag\" href=\"../designer-product/designer-product-list.php\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;상품 등록 현황</a>";
        echo "</div>";
      }
       ?>
  </div>
</aside>
