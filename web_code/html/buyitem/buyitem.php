<!DOCTYPE html>
<html>

<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="buyitem-style.css">
  <script type="text/javascript">
    $(document).ready(function(){
      $("#topnav").load("../topnav.php")
      $("#topnav_login").load("../topnav_login.php")
      $("#header").load("../header.php")
      $("#footer").load("../footer.html")
    });
</script>
<script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
<script>
    function sample4_execDaumPostcode(){
        new daum.Postcode({
            oncomplete: function(data) {
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }
                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample4_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample4_roadAddress').value = fullRoadAddr;
                document.getElementById('sample4_jibunAddress').value = data.jibunAddress;
                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    //예상되는 도로명 주소에 조합형 주소를 추가한다.
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    document.getElementById('guide').innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    document.getElementById('guide').innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';

                }

            }
        }).open();
    }
  </script>

</head>

<body>
  <?php
      include '../../../control/controller.php';
      include '../../../control/buyitem-controller.php';

      if(checkLogin()==true){
        //로그인 페이지로 이동
        echo "<div id=\"topnav_login\"></div>";
      }else{
        echo "<div id=\"topnav\"></div>";
        echo("<script>location.replace('../member/login.php');</script>");
      }
  ?>
  <div id="header"></div>
  <?php
  $p_id = $_GET['id'];

  if($p_id==-1){
  $productList = $_GET['productList'];
  $quantityList = $_GET['quantityList'];
  $cartIDList = $_GET['cartlist'];

  }else{
  $quantity = $_GET['number'];
  }

  $price = $_GET['price'];

  if(isset($_SESSION['userId'])){
  $user_id = $_SESSION['userId'];
  }

  $user_name = buyUserName($user_id);
  $user_phone = buyUserPhone($user_id);
  $user_address1 = buyUserAddress1($user_id);
  $user_address2 = buyUserAddress2($user_id);
  $user_zipcode = buyUserZipcode($user_id);
  $itemType = 0;

  if($price==-1){
    $product_name = buyMaterialName($p_id);
    $itemType = 1;
  }else{
    if($p_id==-1){
      $productArray =explode(':' , $productList);
      $quantityArray =explode(':' , $quantityList);
      $cnt = count($productArray);
      $productNArray = array();

      for($i = 0 ; $i < $cnt ; $i++){
        $productNArray[$i] = buyProductName($productArray[$i]);
      }

    }else{
      $product_name = buyProductName($p_id);
    }

  }

  echo "<div class=\"container\" style=\"text-align:cneter;\" >";
  echo "<div class=\"notice-title\">주문 결제</div>";


  echo "<div class=\"customer-title\">구매자 정보</div>";
  echo "<form name=\"buyinfo\" action=\"buyController.php\" method=\"post\">";
  echo "<table class=\"buytable\" align=\"center\">";
  echo "<tr>";
  echo "<td class=\"title\">이름</td>";
  echo "<td class=\"information\">$user_name</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class=\"title\">연락처</td>";
  echo "<td class=\"information\">$user_phone</td>";
  echo "</tr>";
  echo "</table><br><br>";

  echo "<div class=\"customer-title\" style=\"float : left\">받는사람 정보 </div>";
  echo "<table class=\"buytable\" align=\"center\">";
  echo "<tr>";
  echo "<td class=\"title\">이름</td>";
  echo "<td class=\"information\"><input type=\"text\" name=\"user_name\" value =\"$user_name\"></td>";
  echo "</tr>";
  echo "<tr>";

  echo "<td  rowspan=\"3\" class=\"title\">배송주소</td>";
  echo "<td class=\"information\">
    <input type=\"text\" id=\"sample4_postcode\" readonly name=\"postnum\" value=\"$user_zipcode\">
    <input type=\"button\" onclick=\"sample4_execDaumPostcode()\" value=\"우편번호\"><br>
  </td>";


  echo "</tr>";
  echo "<tr>";


  echo "<td class=\"information\">
    <input type=\"text\" name=\"address1\" id=\"sample4_roadAddress\" readonly placeholder=\"도로명주소\" value=\"$user_address1\"  name=\"address1\"></td>";
  echo "</tr>";
  echo "<tr>";

  echo "<td class=\"information\">
  <input type=\"text\" id=\"detale-address\" name=\"address2\" placeholder=\"상세주소\"  value=\"$user_address2\">
  </td>";


  echo "</tr>";
  echo "<tr>";
  echo "<td class=\"title\">연락처</td>";
  echo "<td class=\"information\"><input type=\"text\" name=\"receiverRequirement\" value = \"$user_phone\"></td>";
  echo "</tr>";
  echo "<td class=\"title\">배송요청사항</td>";
  echo "<td class=\"information\"><input type=\"text\" name=\"receiverRequirement\" placeholder=\"배송요청사항을 입력하세요.\"></td>";
  echo "</tr>";
  echo "</table><br><br>";
  echo "<div class=\"buylist-title\">주문 정보</div>";


  if($p_id==-1){

    $cnt = count($productArray);
    for($i = 0 ; $i < $cnt ; $i++){
      $product_name = $productNArray[$i];
      $quantity = $quantityArray[$i];
          echo "<div class=\"row\">";
      echo "<div class=\"col-sm-6\">$product_name</div>";
      echo "<div class=\"col-sm-2\">수량 $quantity 개</div></div><br>";
    }

  }else{
    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-6\">$product_name</div>";
    echo "<div class=\"col-sm-2\">수량 $quantity 개</div></div><br><br>";

  }


  if($price==-1){
    $totalP = 2500;
    $totalP = $totalP;
    $showTotal = number_format($totalP);
  }else if($p_id!=-1){
    $totalP = $quantity*$price;
    $showTotal = number_format($totalP);
  }

  echo "<div class=\"customer-title\">결제 정보</div>";
  echo "<table class=\"buytable\" align=\"center\">";
  echo "<tr>";
  echo "<td class=\"title\">총 상품 가격</td>";
  echo "<td class=\"information\"> $showTotal 원</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class=\"title\">총 결제 금액</td>";
  echo "<td class=\"information\"> $showTotal 원</td>";
  echo "</tr>";
  echo "<tr>";
  echo "<td class=\"title\">결제 방법</td>";
  echo "<td class=\"information\">무통장입금 *우리은행 1002-852-919 (예금주명 : 권도경)</td>";
  echo "</tr>";

  echo "</table><br><br>";
  echo "<div>
    <p class=\"notice-p\">※ 무통장입금 시 유의사항</p>
    * 입금완료 후 상품품절로 인해 자동취소된 상품은 환불 처리해 드립니다.<br>
    * 은행 이체 수수료가 발생될 수 있습니다. 입금시 수수료를 확인해주세요.<br>
    * 무통장입금 결제 시 부분취소가 불가하며 전체취소 후 다시 주문하시기 바랍니다.
  </div><br><br>";

  echo "<input type=\"hidden\" name=\"productID\" value=\"$p_id\">";
  echo "<input type=\"hidden\" name=\"userID\" value=\"$user_id\">";
  echo "<input type=\"hidden\" name=\"userName\" value=\"$user_name\">";
  echo "<input type=\"hidden\" name=\"quantity\" value=\"$quantity\">";
  echo "<input type=\"hidden\" name=\"receiverTel\" value=\"$user_phone\">";
  echo "<input type=\"hidden\" name=\"totalprice\" value=\"$totalP\">";
  echo "<input type=\"hidden\" name=\"itemType\" value=\"$itemType\">";
  echo "<input type=\"hidden\" name=\"productList\" value=\"$productList\">";
  echo "<input type=\"hidden\" name=\"quantityList\" value=\"$quantityList\">";
  echo "<input type=\"hidden\" name=\"cartList\" value=\"$cartIDList\">";
  echo "<div align=\"center\"><input class=\"btn btn-primary btn-lg\" style=\"text-align:cneter\" type=\"submit\" value=\"결제하기\"></div>";
  echo "</div>";

  echo "</form>";
   ?>

   <br><br>
  <div id="footer"></div>

  </body>
</html>
