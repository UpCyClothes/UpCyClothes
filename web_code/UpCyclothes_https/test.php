<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        //최상단 체크박스 클릭
        $("#checkall").click(function(){
            //클릭되었으면
            if($("#checkall").prop("checked")){
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
                $("input[name=chk]").prop("checked",true);
                //클릭이 안되있으면
            }else{
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
                $("input[name=chk]").prop("checked",false);
            }
        })
    })

  </script>
  <body>
    <table border="1">
      <tr>
          <td><input type="checkbox" id="checkall" /></td>
          <td>이미지</td>
          <td>상품명</td>
          <td>수량</td>
          <td>공백</td>
          <td>가격</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="chk" /></td>
          <td>테스트내용입니다테스트내용입니다</td>
      </tr>
      <tr>
          <td><input type="checkbox" name="chk" /></td>
          <td>안녕하세요개발로짜입니다안녕하세요개발로짜입니다</td>
      </tr>
  </table>

  </body>
</html>
