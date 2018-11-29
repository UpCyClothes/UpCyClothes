<div id="contents">
    <div class="container" >
      <script type="text/javascript">
        $(document).ready(function(){
          $("#subnav").load("../mypage-sub-nav.php")
        });

        function deleteOrder(Rp_name){
          var p_name = Rp_name;
          //var s = nowC."a";
          $.ajax({
            url: 'orderDeleteController.php',
            type: 'post',
            data: {
                'p_name' : p_name
            },
            dataType: 'html',
            success: function(data) {
              alert(data); // 결과 텍스트를 경고창으로 보여준다.
              location.reload();
            },
            error: function(data) {
              alert("server-error : try again");
            }
          });
        }

        function writeReview(Rp_name){
          var p_name = Rp_name;
  
          var productID = document.getElementById("productID").value;

          var url = "../myshop/writeReview.php?id="+productID+"& orderid="+p_name;
          window.location.href = url;
        }

        </script>
    <div id="subnav"></div>

    <div class="shoplist-contents">
      <div class="shoplist-title">
          <span>주문 내역</span>
      </div>
        <!-- 장바구니 상품이 없다면? -->
        <?php
        include '../../../control/buyitem-controller.php';
        include '../../../control/controller.php';
        $user_id = checkID();
        $num = getBuyItemList($user_id);
        $repeatNum = sizeof($num);
        $count=0;
        if($num[0]==0){
          echo "<div class=\"no-item\">";
          echo "<img src=\"../icon-64/cart.png\">";
          echo "$user_id";
          echo "<p class=\"empty-msg\">최근 1개월 이내에 주문한 작품이 없습니다.</p><br>";
          echo "<button type=\"button\" onclick=\"location.href='../index.php'\" class=\"btn btn-default\">작품 구경하러 가기</button>";
          echo "</div>";
        }else{
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
            $productID = orderProductID($order_id);

            echo "<input type=\"hidden\" id=\"productID\" value=\"$productID\">";
            echo "<table class=\"buytable\" align=\"center\">";
            echo "<tr>";
            echo "<td class=\"title\">상품명(주문번호)</td>";
            echo "<td class=\"information\">$productName($order_id)</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class=\"title\">주문일자(주문상태)</td>";
            echo "<td class=\"information\">$orderDate ($orderMessage)</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class=\"title\">결제금액</td>";
            echo "<td class=\"information\">$formatMoney 원</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class=\"title\">배송지</td>";
            echo "<td class=\"information\">$receiveAddress</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td class=\"title\">연락처(받는사람)</td>";
            echo "<td class=\"information\">$receiverTel($receiverName)</td>";
            echo "</tr>";
            echo "</table>";


            $canIwriteReview = doWriteReview($order_id);
            echo "<table style=\"margin:10px\" align=\"right\">";
            echo "<td>";
            if($canIwriteReview == 1){
              echo "<input class=\"btn btn-primary\"  onclick=\"writeReview('$order_id')\" style=\"margin-right:10px\" type=\"submit\" value=\"리뷰작성\">";
            }
            echo "<input class=\"btn btn-warning\"  onclick=\"deleteOrder($order_id)\" type=\"submit\" value=\"주문취소\">";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
            echo "</td>";
            echo "</table>";
            echo "<br><br>";
          }

        }

        ?>
        <p>*여러 상품 주문 건은 리뷰 작성 준비중입니다. </p>
    </div>

</div>
