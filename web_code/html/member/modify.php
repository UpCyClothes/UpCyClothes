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

  <link rel="stylesheet" href="../myshop/new-style.css">
  <script type="text/javascript">
    $(document).ready(function(){
       $("#topnav").load("../topnav.php")
       $("#topnav_login").load("../topnav_login.php")
       $("#header").load("../header.php")
       $("#contents").load("../member/signup-contents.php")
       $("#footer").load("../footer.html")
       $("#subnav").load("../mypage-sub-nav.php")
    });
  </script>
  <script src="/jquery/jquery-3.2.1.min.js"></script>
</head>
<body>
  <script type="text/javascript">
  function checkVaildInput() {
     var addform = document.join;
     if (addform.name.value == ""||addform.tel2.value == "" ||addform.tel3.value == ""
         ||addform.postnum.value == "" || addform.address1.value == ""){
       //1. 필수 정보가 모두 입력되지 않는 경우
       alert("모든 입력란을 다 채워주세요");
       return false;
     }else if(addform.tel3.value.length<4){
        alert("전화번호를 확인해주세요.");
        return false;
      }else{
        return true;
      }
     }

     function memberLeave(userID){
       if (confirm("탈퇴 하시겠습니까?") == true) {
            //탈퇴
            $.ajax({
            url: 'memberleave.php',
            type: 'post',
            data: {
              'id': userID
            },
            dataType: 'html',
            success: function(data) {
              alert(data);
              location.replace('../index.php');
            },
            error: function(data) {
              alert("error : try again");
            }
          });
        }
     }
</script>

  <?php
      include '../../../control/controller.php';
      if(checkLogin()==true){
        echo "<div id=\"topnav_login\"></div>";
      }else{
        //로그인 안되있을 시 -> 로그인으로 페이지 이동시키기.
        echo("<script>location.replace('../member/login.php');</script>");
        echo "<div id=\"topnav\"></div>";
      }
  ?>

      <div id="header"></div>
      <div class="container">
      <div id="subnav"></div>
      <div class="my-page-contents">
        <div class="contentstitle">
          <h4>&nbsp;&nbsp;회원 정보 수정</h4>
        </div>



    <script type="text/javascript" src="member.js"></script>
      <form name="join" onsubmit="return checkVaildInput();" action="memberModifyController.php" method="post">
        <input type="hidden" id="flag" value="-1">
        <input type="hidden" id="flag_nickname" value="-1">
        <br><table id="membertable" style="margin:top:10px" align="center">

          <tr>
            <td class="info">&nbsp;&nbsp;이름</td>
            <td class="memberinput">
              <?php
                  $userName = getUserName();

                  echo "<input id=\"member_name\" class=\"inputinfo2\" type=\"text\" name=\"input_name\" value=\"$userName\" onkeyup=\"checkName(input_name)\"
                  placeholder=\"이름을 바르게 입력하세요\">";
              ?>

           </td>
          </tr>

          <tr>
            <td class="info">&nbsp;&nbsp;주소</td>
            <td class="memberinput">
              <?php
                  $zipcode = getUserZipcode();
                  $add1 = getUserAddress1();
                  $add2 = getUserAddress2();

                  echo "<input type=\"text\" id=\"sample4_postcode\" readonly name=\"postnum\" value=\"$zipcode\" placeholder=\"우편번호\"style=\"margin-left:10px; margin-bottom:10px\">";
                  echo "<input type=\"button\" onclick=\"sample4_execDaumPostcode()\" value=\"우편번호\" style=\"margin-left:10px; margin-bottom:10px\"><br>";
                  echo "<input type=\"text\" id=\"sample4_roadAddress\" readonly placeholder=\"도로명주소\" value=\"$add1\"  name=\"address1\" style=\"margin-left:10px;margin-bottom:10px\"/>";
                  echo "<input type=\"text\" id=\"detale-address\" name=\"address2\" placeholder=\"상세주소\"  value=\"$add2\" style=\"margin-left:10px;margin-bottom:10px\"/>";
              ?>

              <span id="guide" style="color:#999"></span>
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
                <!--
                  print( substr("asdfghjkl", 4,3) );
              -->
              <?php
                $tel = getUserPhone();
                $head = substr($tel, 0,3);
                echo "<option value=\"$head\">$head</option>";
                if(!strcmp($head,"011")){
                  echo "<option value=\"010\">010</option>";
                  echo "<option value=\"019\">019</option>";
                }else if(!strcmp($head,"010")){
                  echo "<option value=\"011\">011</option>";
                  echo "<option value=\"019\">019</option>";
                }else if(!strcmp($head,"019")){
                  echo "<option value=\"011\">011</option>";
                  echo "<option value=\"010\">010</option></select>";
                }
                if($tel.length<=10){
                  $second = substr($tel, 3,3);
                  $third = substr($tel, 6,4);
                  echo "<input type=\"text\" id=\"txtMobile2\" class=\"inputinfo\" size=\"4\" name=\"tel2\" onkeyup=\"checkNumber(tel2)\" value = \"$second\" maxlength=\"4\"/> -";
                  echo "<input type=\"text\" id=\"txtMobile3\" class=\"inputinfo\" size=\"4\" name=\"tel3\" onkeyup=\"checkNumber(tel3)\"  value = \"$third\" maxlength=\"4\"/><br>";
                }else{
                  $second = substr($tel, 3,4);
                  $third = substr($tel, 7,4);
                  echo "<input type=\"text\" id=\"txtMobile2\" class=\"inputinfo\" size=\"4\" name=\"tel2\" onkeyup=\"checkNumber(tel2)\" value = \"$second\" maxlength=\"4\"/> -";
                  echo "<input type=\"text\" id=\"txtMobile3\" class=\"inputinfo\" size=\"4\" name=\"tel3\" onkeyup=\"checkNumber(tel3)\"  value = \"$third\" maxlength=\"4\"/><br>";
                }
               ?>
            </td>
          </tr>

          <tr>
            <td class="info">&nbsp;&nbsp;이메일</td><td class="memberinput">
            <?php
            $userEmail = getUserEmail();
            $userReception = getUserReception();
            echo "<input type=\"email\"  class=\"inputinfo2\" name=\"email\" value=\"$userEmail\">";
             ?>

              <input type="checkbox" name="reception" value="1"> 이메일 수신여부
            </td>
          </tr>

<!-- email 체크여부 name = reception-->
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
          <input type="submit" class="completebtn1" value="정보수정">
          <?php
          session_start();
          if(isset($_SESSION['userId'])){
              $user_id = $_SESSION['userId'];
          }
          echo "<input type=\"hidden\" id=\"userID\" value=\"$user_id\">";
          echo "<input type=\"button\" class=\"completebtn2\"  onclick=\"memberLeave('$user_id')\" value=\"회원 탈퇴\">";
           ?>

        </div>
      </form>
</div></div></div>
<div id="footer"></div>
</body>
</html>
