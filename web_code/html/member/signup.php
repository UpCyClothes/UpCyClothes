 <!DOCTYPE html>
 <html lang="en">
 <head>
   <title>UpCyclothes</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../member/member-style.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
   <script type="text/javascript">
     $(document).ready(function(){
        $("#topnav").load("../topnav.php")
        $("#header").load("../header.php")
        $("#contents").load("../member/signup-contents.php")
        $("#footer").load("../footer.html")
     });
   </script>
   <script src="/jquery/jquery-3.2.1.min.js"></script>
 </head>
 <body>
       <div id="topnav"></div>
       <div id="header"></div>
       <div class = "container">
       <div class="contentstitle">
         <h4>&nbsp;&nbsp;회원 가입</h4>
       </div>
       <div id="line">
         &nbsp;
       </div>
       <script type="text/javascript">
       function checkVaildInput() {
          var addform = document.join;
          if (addform.input_id.value == "" || addform.password.value == ""||addform.password2.value == ""||
              addform.nickname.value == ""||addform.name.value == ""||addform.tel2.value == "" ||addform.tel3.value == ""
              ||addform.postnum.value == "" || addform.address1.value == ""){
            //1. 필수 정보가 모두 입력되지 않는 경우
            alert("모든 입력란을 다 채워주세요");
            return false;
          }else if(addform.flag.value == -1 || addform.flag.value==1){
            //2. 아이디 중복 확인 여부
            alert("아이디 중복 여부를 확인해주세요.");
            return false;
           }else if(addform.flag_nickname.value == -1 || addform.flag_nickname.value==1){
             //3. 닉네임 중복 확인 여부
             alert("닉네임 중복 여부를 확인해주세요.");
             return false;
           }else if(addform.input_id.value == addform.password.value){
             alert("아이디와 비밀번호가 동일합니다.");
             addform.input_id.value = "";
             addform.password.value = "";
             return false;
           }else if(addform.password.value.length<8||addform.password.value.length>16){
             alert("비밀번호는 8~16자를 입력해주세요.");
             return false;
           }else if(!/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,16}$/.test(addform.password.value)) {
              alert("비밀번호는 영문(대소문자구분),숫자,특수문자(~!@#$%^&*()-_? 만 허용)를 혼용하여주세요.");
              return false;
           }else if(addform.tel3.value.length<4){
             alert("전화번호를 확인해주세요.");
             return false;
           }else if(addform.tel2.value.length<4){
             alert("전화번호를 확인해주세요.");
             return false;
           }else{
             return true;
           }
          }
     </script>

     <script type="text/javascript" src="member.js"></script>
       <form name="join" onsubmit="return checkVaildInput();" action="memberController.php" method="post">
         <input type="hidden" id="flag" value="-1">
         <input type="hidden" id="flag_nickname" value="-1">
         <table id="membertable" align="center">
           <tr>
             <td class="info">&nbsp;&nbsp;아이디</td>
             <td class="memberinput">
               <input id="member_id" class="inputinfo2" type="text" name="input_id" value="" onkeyup="checkIDType(input_id)"
               placeholder="4~12자의 소문자 & 숫자">
               <input type="button" name="" value="아이디 확인" class="inputbtn" onclick="checkId(document.join.input_id.value);">
             </td>

           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;비밀번호</td>
             <td class="memberinput">
               <input type="password" class="inputinfo2" name="password"
               placeholder="8~16자의 소문자 & 숫자 $ 특수문자 혼용">
               <!-- <span class="error" style="color:red;" id="errMsg_01"></span> -->
             </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;비밀번호 재입력</td>
             <td class="memberinput">
               <input type="password" class="inputinfo2" name="password2"
               placeholder="8~16자의 소문자 & 숫자 $ 특수문자 혼용">

             </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;닉네임</td>
             <td class="memberinput">
               <input id="member_nickname" class="inputinfo2" type="text" name="nickname" value="">
               <input type="button" name="" value="중복확인" class="inputbtn" onclick="checkNickName(document.join.nickname.value);">
             </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;이름</td>
             <td class="memberinput">
               <input id="member_name" class="inputinfo2" type="text" name="input_name" value="" onkeyup="checkName(input_name)"
               placeholder="이름을 바르게 입력하세요">
            </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;주소</td>
             <td class="memberinput">
               <input type="text" id="sample4_postcode" readonly name="postnum" placeholder="우편번호"style="margin-left:10px; margin-bottom:10px">
               <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호" style="margin-left:10px; margin-bottom:10px"><br>
               <input type="text" id="sample4_roadAddress" readonly placeholder="도로명주소"  name="address1" style="margin-left:10px;margin-bottom:10px"/>
               <input type="text" id="detale-address" name="address2" placeholder="상세주소"  value=" " style="margin-left:10px;margin-bottom:10px"/>
               <span id="guide" style="color:#999"></span>
               <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
               <script>
                   function sample4_execDaumPostcode() {
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

                               } else {
                                   document.getElementById('guide').innerHTML = '';
                               }
                           }
                       }).open();
                   }
                 </script>
             </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;전화번호</td>
             <td>
               <select id="txtMobile1" name="tel1" class="memberinput">
                 <option value="">::선택::</option>
                 <option value="011">011</option>
                 <option value="017">017</option>
                 <option value="010">010</option>
               </select>
               <input type="text" id="txtMobile2" class="inputinfo" size="4" name="tel2" onkeyup="checkNumber(tel2)" maxlength="4"/> -
               <input type="text" id="txtMobile3" class="inputinfo" size="4" name="tel3" onkeyup="checkNumber(tel3)" maxlength="4"/><br/>
             </td>
           </tr>

           <tr>
             <td class="info">&nbsp;&nbsp;이메일</td>
             <td class="memberinput"> <input type="email"  class="inputinfo2" name="email">
               <input type="checkbox" name="reception" value="1"> 이메일 수신여부
             </td>
           </tr>

<!-- email 체크여부 name = reception-->

           <tr>
             <td class="info">&nbsp;&nbsp;디자이너/손님</td>
             <td class="memberinput">
               <!-- <label><input type="radio"  class="inputinfo2" name="type" value="디자이너">디자이너 </label>
               <label><input type="radio"  class="inputinfo2"  name="type" value="손님"> 손님</label>     -->
               <label><input type='radio' name='type' value='0' style="margin-left:30px;" checked ="checked"/>  디자이너</label>
               <label><input type='radio' name='type' value='1' style="margin-left:30px;" />  손님</label>
            </td>
           </tr>
           <script language="JavaScript">
                <!--
                // 설정 시작
                var maxChecked = 2;
                var totalChecked = 0;
                // 설정 끝
                function CountChecked(field) {
                  if (field.checked)
                  totalChecked += 1;
                  else
                  totalChecked -= 1;
                  if (totalChecked > maxChecked) {
                  alert ("최대 2개 까지만 가능합니다.");
                  field.checked = false;
                  totalChecked -= 1;
                  }
                }
                function ResetCount(){
                  totalChecked = 0;
                }
                //-->
          </script>
           <tr>
             <td class="info">&nbsp;&nbsp;선호 취향</td>
             <td class="memberinput" style="margin-left:30px;">
                     <input type="checkbox"  onclick=CountChecked(this)  name="consumer[]" value="1" style="margin-left:30px;"> 옷
                     <input type="checkbox"  onclick=CountChecked(this)  name="consumer[]" value="2"> 가방
                     <input type="checkbox"  onclick=CountChecked(this)  name="consumer[]" value="3"> 악세사리
                     <input type="checkbox"  onclick=CountChecked(this)  name="consumer[]" value="4"> 지갑
                     <input type="checkbox"  onclick=CountChecked(this)  name="consumer[]" value="5"> 신발
             </td>
           </tr>
         </table>
         <!-- tag1, tag2 정보 넘기기 -->

         <div id="bottomContents" align="center">
           <input type="submit" class="completebtn1" value="회원가입">
           <input type="button" class="completebtn2"  onclick="location.href='../index.php';" value="회원가입 취소">
         </div>
       </form>
</div>
<div id="footer"></div>
 </body>
 </html>
