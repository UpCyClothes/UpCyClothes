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
          <a class="icon" href="../shoplist/shoplist.php">더보기></a>
        </div>
        <?php
        include '../../../control/mycart-controller.php';
        include '../../../control/controller.php';
        include '../../../control/buyitem-controller.php';
        $user_id = checkID();
        $num = getBuyItemList($user_id);
        $repeatNum = sizeof($num);
        $count=0;
        if($num[0]==0){
          echo "<p class=\"empty-msg\">최근 1개월 이내에 주문한 작품이 없습니다.</p>";
        }else{

          if($repeatNum>5){
            $repeatNum = 5; //5개만 나오도록
          }
          echo "<table>";
          while($repeatNum>0){
            $order_id = $num[$count];


            $resultarray = array();
            $resultarray = orderInformation($order_id);
            $orderDate = $resultarray[10];
            $orderState = $resultarray[12];

            $totalPrice = $resultarray[11];
            $receiveAddress = $resultarray[4]." ".$resultarray[5];
            $receiverTel = $resultarray[8];
            $receiverName = $resultarray[3];
            $formatMoney = number_format($totalPrice);
            $itemType = $resultarray[13];
            if($itemType==1){
                $productName = orderMaterialName($order_id);
            }else{
                $productName = orderProductName($order_id);
            }


            //
            if($orderState==1){
              $orderMessage = "주문 접수";
            }else if($orderState==2){
              $orderMessage = "입금 확인";
            }else if($orderState==3){
              $orderMessage = "배송 준비중";
            }else if($orderState==4){
              $orderMessage = "배송 시작";
            }else if($orderState==5){
              $orderMessage = "배송 완료";
            }else if($orderState==6){
              $orderMessage = "주문 취소";
            }

            echo "<tr>";
            echo "<td class=\"col-md-5\">$productName($order_id)</td>";
            echo "<td class=\"col-md-4\">$orderDate ($orderMessage)</td>";
            echo "<td class=\"col-md-2\">$formatMoney 원</td>";
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
          <span>장바구니</span>
          <a class="icon" href="../wishlist/wishlist.php">더보기></a>
        </div>

        <!-- 관심 상품이 없다면? -->
        <?php
        $user_id = checkID();
        $num = getCart($user_id);
        $repeatNum = sizeof($num);
        $count=0;
        if($num==0){
          echo "<p class=\"empty-msg\">장바구니가 비어있네요! 관심 상품을 담아보세요.</p>";
        }else{

          if($repeatNum>5){
            $repeatNum = 5; //5개만 나오도록
          }
          echo "<table>";
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
            echo "<td class=\"col-md-2\" style=\"padding:5px\"><img src=\"$productURL\" style = \"width:50px; height:50px\" >&nbsp;</td>";
            echo "<td class=\"col-md-8\" style=\"padding:5px\">&nbsp;$productName&nbsp;</td>";
            echo "<td class=\"col-md-2\" style=\"padding:5px\">$designer&nbsp;</td>";
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
