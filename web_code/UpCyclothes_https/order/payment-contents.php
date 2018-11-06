<div id="contents">
  <div class="container">

      <script type="text/javascript">
        $(document).ready(function(){
          $("#subnav").load("../mypage-sub-nav.php")
        });
        </script>
      <div id="subnav"></div>

    <div class="payment-contents">
      <div class="payment-title">
          <span>주문 내역</span>
      </div>
        <!-- 주문 상품이 없다면? -->
        <div class="no-item">
          <img src="../icon-64/cart.png" alt="">
          <p class="empty-msg">최근 1개월 이내에 주문한 작품이 없습니다.</p><br>
          <button type="button" onclick="location.href='../index.php'" class="btn btn-default">작품 구경하러 가기</button>
        </div>

        <!-- 주문 상품이 있면? -->
        <div class="yes-item">
          <!--Contents-DB연결-->
        </div>

  </div>
</div>
