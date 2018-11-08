
<script type="text/javascript">

  Number.prototype.format = function() {
    if (this == 0) return 0;

    var reg = /(^[+-]?\d+)(\d{3})/;
    var n = (this + '');

    while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

    return n;
  };

  function downBtn() {
    var number = document.getElementById("quantity").value;
    var nowPrice = document.getElementById("originprice").value;
    if (parseInt(number) - 1 < 0) {
      alert("입력 범위를 초과하였습니다.");
    } else {
      var price = parseInt(nowPrice) * (parseInt(number) - 1);

      if (isNaN(price)) {
        document.getElementById("tPrice").innerHTML = "0";
      } else {
        document.getElementById("quantity").value = (parseInt(number) - 1);
        price = price.format();
        document.getElementById("tPrice").innerHTML = price;
      }
    }

  }

  function upBtn() {
    var number = document.getElementById("quantity").value;
    var nowPrice = document.getElementById("originprice").value;
    if (parseInt(number) + 1 > 999) {
      alert("입력 범위를 초과하였습니다.");
    } else {
      var price = parseInt(nowPrice) * (parseInt(number) + 1);
      if (isNaN(price)) {
        document.getElementById("tPrice").innerHTML = "0";
      } else {
        document.getElementById("quantity").value = (parseInt(number) + 1);
        price = price.format();
        document.getElementById("tPrice").innerHTML = price;
      }
    }
  }

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
        $count=0;
        if($num==0){
          echo "<div class=\"no-item\">";
          echo "<img src=\"../icon-64/wishlist.png\">";
          echo "<p class=\"empty-msg\">장바구니가 비어있습니다.</p><br>";
          echo "<button type=\"button\" onclick=\"../index.php\" class=\"btn btn-default\">작품 구경하러 가기</button>";
          echo "</div>";
        }else{
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
            //삭제 버튼 추가
            echo "<td><img src=\"$productURL\" style = \"width:50px; height:50px\" >&nbsp;</td>";
            echo "<td><a href=\"../detail-board.php?id=$p_id\">&nbsp;$productName&nbsp;</td>";
            echo "<td>&nbsp;$designer&nbsp;</td>";
            echo "<td id=\"quantity\">&nbsp;$c&nbsp; </td>";
            echo "<td><img src=\"../icon-16/same.png\" style = \"width:10px; height:10px\" >&nbsp;</td>";
            echo "<td>&nbsp;$price&nbsp;</td>";
            //echo "<input type=\"hidden\" id=\"p_hidden_$productName\" value=\"$productName\">";
            echo "<td><img src=\"../icon-16/delete.png\" onclick=\"deleteCart($cart_id)\" style = \"width:20px; height:20px\" >&nbsp;</td>";
            echo "</tr>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
        echo "</table>";
        }

        ?>

        <!-- 찜한 상품이 있다면?-->

    </div>

</div>
