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
        $("#footer").load("../footer.html")
     });
   </script>
 </head>
 <body>
       <div id="topnav"></div>
       <div id="header"></div>
       <div class = "container">
       <div class="contentstitle">
         <h4>&nbsp;&nbsp;배송지 정보 수정</h4>
       </div>
       <div id="line">
         &nbsp;
       </div>
       <script type="text/javascript">
         function checkVaildInput() {
           var addform = document.join;
           if (addform.zipCode.value == "" || addform.address.value == "" ||addform.address2.value == ""){
             alert("모든 입력란을 다 채워주세요");
             return false;
           }else{
             return true;
           }
         }
       </script>

       <script type="text/javascript" src="member.js"></script>

       <form name="join" onsubmit="return checkVaildInput();" action="memberModifyController.php" method="post">
         <table id="membertable" align="center">
          <tr>
             <td class="info">&nbsp;&nbsp;주소</td>
             <td class="memberinput">
               <!-- <input type="text" name="zipCode" class="postcodify_postcode5" style="margin-left:10px;"/> -->
               <input type="text" id="sample4_postcode" name="postnum" placeholder="우편번호"style="margin-left:10px; margin-bottom:10px">
               <input type="button" onclick="sample4_execDaumPostcode()" value="우편번호" style="margin-left:10px; margin-bottom:10px"><br>
               <input type="text" id="sample4_roadAddress" placeholder="도로명주소"  name="address1" style="margin-left:10px;margin-bottom:10px"/>
               <!-- <input type="text" id="sample4_jibunAddress" placeholder="지번주소"  name="tempaddress" style="margin-left:10px;margin-bottom:10px"/> -->
               <input type="text" id="detale-address" name="address2" placeholder="상세주소" style="margin-left:10px;margin-bottom:10px"/>
               <span id="guide" style="color:#999"></span>
               <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
               <script>
                   //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
                   function sample4_execDaumPostcode() {
                       new daum.Postcode({
                           oncomplete: function(data) {
                               // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                               // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                               // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                               var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                               var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                               // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                               // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                               if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                                   extraRoadAddr += data.bname;
                               }
                               // 건물명이 있고, 공동주택일 경우 추가한다.
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


         </table>
         <!-- tag1, tag2 정보 넘기기 -->

         <div id="bottomContents" align="center">
           <input type="submit" class="completebtn1" value="정보 변경">
           <input type="button" class="completebtn2"  onclick="location.href='../index.php';" value="변경 취소">
         </div>
       </form>
</div>
<div id="footer"></div>
 </body>
 </html>
