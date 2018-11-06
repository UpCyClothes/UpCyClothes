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
        if (addform.category.value == ""||addform.title.value == ""||addform.price.vale==""
            || addform.quantitiy.value==""){
          alert("모든 입력란을 다 채워주세요");
          return false;
        }else{
          return true;
        }

      }
    </script>

    <script type="text/javascript" src="member.js"></script>
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
            <input id="register-price" class="inputinfo2" type="text" name="price" value="" placeholder="숫자만 입력하세요">
            <!--닉네임 중복확인 구현하기-->
          </td>
        </tr>
        <tr>
          <td class="info">&nbsp;&nbsp;* 재고수량</td> <!--숫자만 입력-->
          <td class="registerinput">
            <input id="register-quantitiy" class="inputinfo2" type="text" name="quantitiy" value="" placeholder="숫자만 입력하세요" >
          </td>
        </tr>
        <script type="text/javascript">
      	function formSubmit(f) {
      		var extArray = new Array('hwp','xls','doc','xlsx','docx','pdf','jpg','gif','png','txt','ppt','pptx');
      		var path = document.getElementById("upfile").value;
      		if(path == "") {
      			alert("파일을 선택해 주세요.");
      			return false;
      		}

      		var pos = path.indexOf(".");
      		if(pos < 0) {
      			alert("확장자가 없는파일 입니다.");
      			return false;
      		}

      		var ext = path.slice(path.indexOf(".") + 1).toLowerCase();
      		var checkExt = false;
      		for(var i = 0; i < extArray.length; i++) {
      			if(ext == extArray[i]) {
      				checkExt = true;
      				break;
      			}
      		}

      		if(checkExt == false) {
      			alert("업로드 할 수 없는 파일 확장자 입니다.");
      		    return false;
      		}

      		return true;
      	}
      	</script>
        <tr>
          <td class="info">&nbsp;&nbsp;* 상품이미지</td> <!--숫자만 입력-->
          <td class="registerinput">
            <form name="uploadForm" id="uploadForm" method="post" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
              <input type="file" name="upfile" id="upfile" />

            </form>
          </td>
        </tr>

        <tr>
          <td class="info">&nbsp;&nbsp;* 상세상품이미지</td> <!--숫자만 입력-->
          <td class="registerinput">
            <form name="uploadForm" id="uploadForm" method="post" enctype="multipart/form-data" onsubmit="return formSubmit(this);">
              <input type="file" name="upfile" id="upfile" />
            </form>
          </td>
        </tr>
      </table>
      <!-- tag1, tag2 정보 넘기기 -->

      <div id="bottomContents" align="center">
        <input type="submit" class="completebtn1" value="상품 등록">
        <input type="button" class="completebtn2"  onclick="location.href='../index.php';" value="등록 취소">
      </div>
      </form>
  </div>
