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

        if($repeatNum==1 && $array[0]=="0"){
            echo "<p class=\"empty-msg\">등록 대기중인 상품이 없습니다.</p>";
        }else{
        echo "<table style=\"margin:30px\">";
            while($repeatNum>0){
              $productName = getRegisterProductName($array[$count]);

              echo "<tr>";
              echo "<td class=\"col-md-1\" style=\"padding:5px;\"><img src=\"../icon-64/wait.png\" style = \"width:20px; height:20px\" >&nbsp;</td>";
              echo "<td class=\"col-md-8\"style=\"padding:5px;\">$productName</td>";
              echo "<td class=\"col-md-8\"style=\"padding:5px;\"> 등록 대기중</td>";
              echo "</tr>";

              $repeatNum = $repeatNum-1;
              $count = $count+1;
            }
        echo "</table>";
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
        ?>
      </div>

    </div>
  </div>
</div>
