<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <div module="Product_BasketAdd">
        <!--@css(/css/module/product/basketAdd.css)-->
        <h1>장바구니 담기</h1>
        <div class="content">
            <p>장바구니에 상품이 정상적으로 담겼습니다.</p>
        </div>
        <div class="btnArea center">
            <a href="/order/basket.html?delvtype={$delvtype}"><img src="http://img.echosting.cafe24.com/skin/base_ko_KR/product/btn_go_basket.gif" alt="장바구니 이동" /></a>
            <a href="#none" onclick="$('#confirmLayer').hide();"><img src="http://img.echosting.cafe24.com/skin/base_ko_KR/product/btn_continue_shopping.gif" alt="쇼핑계속하기" complete="complete" /></a>
        </div>
        <div class="close"><a onclick="$('#confirmLayer').hide();"><img src="http://img.echosting.cafe24.com/skin/base_ko_KR/common/btn_close.png" alt="닫기" /></a></div>
    </div>
  </body>
</html>
