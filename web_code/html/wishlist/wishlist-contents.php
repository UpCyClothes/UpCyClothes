
<script type="text/javascript">

  Number.prototype.format = function() {
    if (this == 0) return 0;

    var reg = /(^[+-]?\d+)(\d{3})/;
    var n = (this + '');

    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

    return n;
  };


  function deleteCart(Rp_name){
    var p_name = Rp_name;
    //var s = nowC."a";
    $.ajax({
      url: 'cartDeleteController.php',
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

  var totalChecked = 0;

  function buy_action(){
    var p_list = document.getElementById("productList").value;
    var o_price = document.getElementById("totalPrice").value;
    var q_list = document.getElementById("quantityList").value;
    var c_list = document.getElementById("cartidList").value;
    var url = "../buyitem/buyitem.php?id=-1"+"&productList="+p_list+"&quantityList="+q_list+"&price="+o_price+"&cartlist="+c_list;
    window.location.href = url;
  }


  function checkCount(field){
      if (field.checked)totalChecked += 1;
  }

  function selectRow() {
    //넘겨줘야 하는 정보 : p_list, q_list, o_price
    var chk = document.getElementsByName("selectList[]"); // 체크박스객체를 담는다
    var len = chk.length;    //체크박스의 전체 개수
    var checkRow = '';      //체크된 체크박스의 value를 담기위한 변수
    var checkCnt = 0;        //체크된 체크박스의 개수
    var checkLast = '';      //체크된 체크박스 중 마지막 체크박스의 인덱스를 담기위한 변수
    var rowid = '';             //체크된 체크박스의 모든 value 값을 담는다
    var cnt = 0;
    var p_list = document.getElementById("productList").value
    var price_list = document.getElementById("priceList").value;
    var q_list = document.getElementById("quantityList").value;
    var c_list = document.getElementById("cartidList").value;
    //var afterStr = beforeStr.split('-');
    var select_product_list = "";
    var select_price = 0;
    var select_quantity_list = "";
    var select_cartID_list = "";

    var p_after = p_list.split(':');
    var o_after = price_list.split(':');
    var q_after = q_list.split(':');
    var c_after = c_list.split(':');

    for(var i=0; i<len; i++){
        if(chk[i].checked == true){
          checkCnt++;        //체크된 체크박스의 개수
          if(select_product_list==""){
            select_product_list = p_after[i];
          }else{
            select_product_list = select_product_list+":"+p_after[i];
          }

          select_price = select_price+parseInt(o_after[i]);

          if(select_quantity_list==""){
            select_quantity_list = q_after[i];
          }else{
            select_quantity_list = select_quantity_list+":"+q_after[i];
          }

          if(select_cartID_list==""){
            select_cartID_list = c_after[i];
          }else{
            select_cartID_list = select_cartID_list+":"+c_after[i];
          }
      }
    }

    if(len == checkCnt){
      //만약에 선택한 갯수랑 내 상품의 갯수랑 같다면? -> buy_action()해버리기!
      buy_action();
    }else{
      var url = "../buyitem/buyitem.php?id=-1"+"&productList="+select_product_list+"&quantityList="+select_quantity_list+"&price="+select_price+"&cartlist="+select_cartID_list;
      window.location.href = url;
    }

}


</script>
<div id="contents">
    <div class="container" >
      <script type="text/javascript">
        $(document).ready(function(){
          $("#subnav").load("../mypage-sub-nav.php")
        });
        </script>
      <div id="subnav"></div>

    <div class="payment-contents">
      <div class="payment-title">
          <span>장바구니 목록</span>
      </div>
        <!-- 장바구니 상품이 없다면? -->
        <?php
        include '../../../control/mycart-controller.php';
        include '../../../control/controller.php';
        $user_id = checkID();
        $num = getCart($user_id);
        $repeatNum = sizeof($num);
        $productList = "";
        $quantityList = "";
        $priceList = "";
        $cartidList = "";
        $count=0;
        $totalPrice;
        if($num==0){
          echo "<div class=\"no-item\">";
          echo "<img src=\"../icon-64/wishlist.png\">";
          echo "<p class=\"empty-msg\">장바구니가 비어있습니다.</p><br>";
          echo "<button type=\"button\" onclick=\"location.href='../index.php'\" class=\"btn btn-default\">작품 구경하러 가기</button>";
          echo "</div>";
        }else{

          echo "<table style=\"border-spacing:10px\">";
          while($repeatNum>0){
            $cart_id = $num[$count];
            $p_id = getCartproductID($cart_id);
            $designer = getDesigner($cart_id);
            $productName = getproductName($cart_id);
            $c = getcount($cart_id);
            $price = getprice($cart_id);
            $totalPrice += $price;

            $url = "..";
            $productURL = getproductURL($cart_id);
            $productURL = $url.$productURL;
            $originPrice = ($price/$c);
            if($count==0){
              $productList = $productList.$p_id;
              $quantityList = $quantityList.$c;
              $priceList = $priceList.$price;
              $cartidList = $cartidList.$cart_id;
            }else{
              $productList = $productList.":".$p_id;
              $quantityList = $quantityList.":".$c;
              $priceList = $priceList.":".$price;
              $cartidList = $cartidList.":".$cart_id;
            }

            $price =  number_format($price);
            echo "<tr>";
            //삭제 버튼 추가  onclick=\"selectOrder(this)\" style="margin-bottom:10px; padding:10px"
            echo "<td class=\"col-md-1\"><input type=\"checkbox\" onclick=\"checkCount(this)\" name=\"selectList[]\" value=\"$p_id\">&nbsp;</td>";
            echo "<td class=\"col-md-2\" style=\"padding:10px\"><img src=\"$productURL\" onclick=\"checkCount(this)\" style =\"width:70px; height:70px\" >&nbsp;</td>";
            echo "<td class=\"col-md-5\" style=\"padding:10px\"><a href=\"../detail-board.php?id=$p_id\">&nbsp;$productName&nbsp;</td>";
            echo "<td class=\"col-md-2\" style=\"padding:10px\">&nbsp;$designer&nbsp;</td>";
            echo "<td class=\"col-md-1\" style=\"padding:10px\" id=\"quantity\">&nbsp;$c&nbsp;개</td>";
            echo "<td class=\"col-md-2\" style=\"padding:10px\">&nbsp;$price&nbsp;</td>";
            //echo "<input type=\"hidden\" id=\"p_hidden_$productName\" value=\"$productName\">";
            echo "<td class=\"col-md-1\"><img src=\"../icon-16/delete.png\" onclick=\"deleteCart($cart_id)\" style = \"width:20px; height:20px\"></td>";
            echo "</tr>";
            echo "<tr>";

            echo "</tr>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
          echo "</table><br>";
          $priceString =number_format($totalPrice);
          echo "<div class = \"wish-order\">";


          echo "<span class=\"total\">장바구니 총 가격 &nbsp; $priceString 원&nbsp;</span>";
          echo "<input type=\"hidden\" id=\"productList\" value=\"$productList\">";
          echo "<input type=\"hidden\" id=\"totalPrice\" value=\"$totalPrice\">";
          echo "<input type=\"hidden\" id=\"quantityList\" value=\"$quantityList\">";
          echo "<input type=\"hidden\" id=\"priceList\" value=\"$priceList\">";
          echo "<input type=\"hidden\" id=\"cartidList\" value=\"$cartidList\">";
          echo "<button type=\"button\" style = \"align:right; margin-right:10px;\" onclick=\"selectRow()\" class=\"btn btn-default\">선택 주문</button>";
          echo "<button type=\"button\" style = \"align:right\" onclick=\"buy_action()\" class=\"btn btn-default\">전체 주문</button>";
          echo "</div>";

        }

        ?>
    </div>

</div>
