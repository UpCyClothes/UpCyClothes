function checkId(userId) {
  if (userId == "") {
    alert("아이디를 입력해 주세요.");
  } else {
    $.ajax({
    url: 'idCheck.php',
    type: 'post',
    data: {
      'id': userId
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


function checkNickName(userNickName) {
    
    if (userNickName == "") {
          alert("닉네임을 입력해 주세요.");
    } else {
      $.ajax({
        url: 'nicknameCheck.php',
        type: 'post',
        data: {
          'nickname': userNickName
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

function checkNumber(chr){
  if(isNaN(chr.value)){
      alert("숫자만 입력하세요");
      chr.value="";
  }
}

function testing(){
      alert("Success");
}
