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
      <div class="my-page-title">상품 등록 현황</div>
      <!-- 주문 내역 -->
      <div class="my-page-sub">
        <div class="my-page-title-sub">
          <span>등록 대기중</span>
        </div>
        <br>
        <!-- php코드 작성 -->
        <?php
        include '../../../control/register-controller.php';
        $array = getRegisterProduct();
        $repeatNum = sizeof($array);
        $count=0;
        if($repeatNum==0){
            echo "<p class=\"empty-msg\">등록 대기중인 상품이 없습니다.</p>";
        }else{

            while($repeatNum>0){
              $productName = getRegisterProductName($array[$count]);
              echo "<p>$productName : 등록 대기중</p>";
              $repeatNum = $repeatNum-1;
              $count = $count+1;
            }
        }
        ?>

      </div>

      <div class="my-page-sub">
        <div class="my-page-title-sub">
          <span>등록 완료</span>
        </div>
        <br>
        <?php

        $array2 = getRegisterProductComplete();
        $repeatNum2 = sizeof($array2);
        $count2=0;
      echo "<p class=\"empty-msg\">등록 완료 된 상품이 없습니다.</p>";
      //수정해야해
        // if($repeatNum2==0){
        //     echo "<p class=\"empty-msg\">등록 완료 된 상품이 없습니다.</p>";
        // }else{
        //     while($repeatNum2>1){
        //       $productName2 = getRegisterProductName($array2[$count2]);
        //       echo "<p>$productName2 : 등록 완료되었습니다. MARKET을 확인해보세요!</p>";
        //       $repeatNum2 = $repeatNum2-1;
        //       $count2 = $count2+1;
        //     }
        // }
        ?>
      </div>

    </div>
  </div>
</div>
