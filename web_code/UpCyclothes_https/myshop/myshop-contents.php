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
          <a class="icon" href="#">더보기></a>
        </div>
        <!-- 관심 상품이 없다면? -->
        <p class="empty-msg">관심 상품이 없습니다. 관심 상품을 담아보세요.</p>
      </div>

    </div>
  </div>
</div>
