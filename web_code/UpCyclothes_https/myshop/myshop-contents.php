<div id = contents>
  <div class="container" >
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../mypage-sub-nav.php")
      });
  </script>
    <div id="subnav"></div>
    <!--My Page 내용물-->
    <div class="my-page-contents">
      <div class="my-page-title">MY PAGE</div>
      <!-- 주문 내역 -->
      <div class="my-page-sub">
        <div class="my-page-title-sub">
          <span>최근 주문 내역</span>
          <a class="icon" href="#">더보기></a>
        </div>
        <!-- 주문 상품이 없다면? -->
        <p class="empty-msg">최근 1개월 이내에 주문한 작품이 없습니다.</p>
      </div>

      <div class="my-page-sub">
        <div class="my-page-title-sub">
          <span>관심 상품</span>
          <a class="icon" href="../wishlist/wishlist.php">더보기></a>
        </div>

        <!-- 관심 상품이 없다면? -->
        <?php
        include '../../../control/mycart-controller.php';
        include '../../../control/controller.php';
        $user_id = checkID();
        $num = getCart($user_id);
        $repeatNum = sizeof($num);
        $count=0;
        if($num==0){
          echo "<p class=\"empty-msg\">관심 상품이 없습니다. 관심 상품을 담아보세요.</p>";
        }else{
          echo "<table>";
          if($repeatNum>5){
            $repeatNum = 5; //5개만 나오도록
          }
          while($repeatNum>0){
            $cart_id = $num[$count];
            $p_id = getCartproductID($cart_id);
            $designer = getDesigner($cart_id);
            $productName = getproductName($cart_id);
            $c = getcount($cart_id);
            $price = getprice($cart_id);
            $price = number_format($price);
            $url = "..";
            $productURL = getproductURL($cart_id);
            $productURL = $url.$productURL;
            $originPrice = ($price/$c);
            echo "<tr>";
            echo "<td><img src=\"$productURL\" style = \"width:50px; height:50px\" >&nbsp;</td>";
            echo "<td><a href=\"../detail-board.php?id=$p_id\">&nbsp;$productName&nbsp;</td>";
            echo "<td>&nbsp;$designer&nbsp;</td>";
            echo "</tr>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
        echo "</table>";
        }

        ?>

      </div>

    </div>
  </div>
</div>
