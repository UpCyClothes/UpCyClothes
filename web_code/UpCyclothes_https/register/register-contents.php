  <div  id = "contents"  class="container">
    <div class="contentstitle">
      <h4>&nbsp;&nbsp;상품 등록</h4>
    </div>
    <div id="line">
      &nbsp;
    </div>
    <script type="text/javascript">
      function checkVaildInput() {
        var addform = document.item;
        if (addform.category.value== ""||addform.title.value == ""||addform.price.vale==""
            || addform.quantitiy.value==""){
          alert("모든 입력란을 다 채워주세요");
         return false;
        }else{
         return true;
        }
      }
      function checkNumber(chr){
        if(isNaN(chr.value)){
            alert("숫자만 입력하세요");
            chr.value="";
        }
      }
      function checkProductName(productName) {
          if (productName == "") {
                alert("상품명을 입력해 주세요.");
          } else {
            $.ajax({
              url: 'productNameController.php',
              type: 'post',
              data: {
                'productName': productName
              },
              dataType: 'html',
              success: function(data) {
                alert(data); // 결과 텍스트를 경고창으로 보여준다.
              },
              error: function(data) {
                alert("error : try again");
              }
            });
          }
      }
    </script>
    <p>*부분은 필수 입력란입니다.</p>
    <form name="item" onsubmit="return checkVaildInput();" action="item-register-controller.php" method="post">
      <table id="registertable" align="center">
        <tr>
          <td class="info">&nbsp;&nbsp;* 분류</td>
          <td>
            <select id="rcategory" name="category" class="registerinput">
              <option value="">::선택::</option>
              <option value="1">Clothes</option>
              <option value="2">Bags</option>
              <option value="3">Accessories</option>
              <option value="4">Shoes</option>
              <option value="5">Wallet</option>
            </select>
          </td>
        </tr>
        <tr>
          <td class="info">&nbsp;&nbsp;* 상품명</td>
          <td class="registerinput">
            <input id="register-title" class="inputinfo2" type="text" name="title" value="">
            <input type="button" name="" value="중복확인" class="inputbtn" onclick="checkProductName(document.item.title.value);">
          </td>
        </tr>

        <tr>
          <td class="info">&nbsp;&nbsp;상품설명(한 줄)</td>
          <td class="registerinput">
            <input id="register-distcription" class="inputinfo2" type="text" name="distcription" value="">
          </td>
        </tr>

        <tr>
          <td class="info">&nbsp;&nbsp;* 가격</td>
          <td class="registerinput">
            <input id="register-price" class="inputinfo2" type="text"  onkeyup="checkNumber(price)" name="price" value="" placeholder="숫자만 입력하세요">
            <!--상품 명 중복확인 구현하기-->
          </td>
        </tr>
        <tr>
          <td class="info">&nbsp;&nbsp;* 재고수량</td> <!--숫자만 입력-->
          <td class="registerinput">
            <input id="register-quantitiy" class="inputinfo2" type="text" onkeyup="checkNumber(quantitiy)" name="quantitiy" value="" placeholder="숫자만 입력하세요" >
          </td>
        </tr>
      </table>
      <br>
      <p>*썸네일과 상세 이미지는 dkdk6638@naver.com으로 양식에 맞추어 보내주시면 됩니다.</p>

      <!-- tag1, tag2 정보 넘기기 -->

      <div id="bottomContents" align="center">
        <input type="submit" class="completebtn1" value="상품 등록 요청">
        <input type="button" class="completebtn2"  onclick="location.href='../index.php';" value="등록 취소">
      </div>
      </form>
  </div>
