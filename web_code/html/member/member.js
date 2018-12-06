function checkId(userId) {
var checkNumber = userId.search(/[0-9]/g);
var checkEnglish = userId.search(/[a-z]/ig);
  if (userId == "") {
    alert("아이디를 입력해 주세요.");

  }else{
    if(userId.length>=4&&userId.length<=12){
      if(!/^(?=.*[a-zA-Z])(?=.*[0-9]).{4,12}$/.test(userId)){
        alert("아이디를 영문과 숫자를 혼용하여 입력하세요.");
        document.getElementById("member_id").value = "";
      }else{
          $.ajax({
          url: 'idCheck.php',
          type: 'post',
          data: {
            'id': userId
          },
          dataType: 'html',
          success: function(data) {
            if(data == 1){
                alert("사용 가능한 아이디입니다.");
                document.getElementById("flag").value=0;
            }else if(data == 0){
                document.getElementById("flag").value=1;
                document.getElementById("member_id").value = "";
                alert("중복 된 아이디입니다. 다른 아이디를 입력하세요.");
            }
          },
          error: function(data) {
            alert("error : try again");
          }
        });
      }
    }else{
      alert("아이디를 4~12자로 입력하세요.");
      document.getElementById("member_id").value = "";
    }
  }
}


function checkNickName(userNickName) {
  if(userNickName == ""){
    alert("닉네임을 입력해 주세요.");}
  else{
    $.ajax({
      url: 'nicknameCheck.php',
      type: 'post',
      data: {
        'nickname': userNickName
      },
      dataType: 'html',
      success: function(data){
        if(data == 1){
          alert("사용 가능한 닉네임 입니다.");
          document.getElementById("flag_nickname").value=0;
        }else{
          document.getElementById("flag_nickname").value=1;
          alert("중복 된 닉네임입니다. 다른 닉네임을 입력하세요.");
          userNickName.value = "";
        }
      },
      error: function(data) {
        alert("error : try again");
      }
    });
  }
}

function checkNumber(chr){
  if(isNaN(chr.value)){
      alert("숫자만 입력하세요");
      chr.value="";
  }
}

function checkIDType(chr){

  for (i = 0; i < chr.value.length; i++) {
           ch = chr.value.charAt(i);
           if (!(ch >= '0' && ch <= '9') && !(ch >= 'a' && ch <= 'z')) {
               alert("아이디는 소문자, 숫자만 입력가능합니다.");
               chr.value="";
           }
  }
}

function checkName(chr) {
  var stringRegx = /[~!.,@\#$%<>^&*\()\-=+_\’]/gi;
  for (i = 0; i < chr.value.length; i++){
  ch = chr.value.charAt(i);
   if (stringRegx.test(ch)||(!isNaN(ch))){
    alert("특수문자 혹은 숫자는 입력하실 수 없습니다.");
    chr.value="";
   }
  }
}
