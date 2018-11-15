<div id = contents>
  <div class="container">
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../mypage-sub-nav.php")
        $("#click-before").load("click-before.php")
      });

      function answerDetail($messengerID){
        $.ajax({
        url: 'answerClickController.php',
        type: 'post',
        data: {
          'messengerID': $messengerID
        },
        async: false,
        success: function(data){
         if(data){
           // 데이터를 JSON으로 파싱
           var json = JSON.parse(data);
           console.log(json.results)
           var dom = '';
           for(i in json.results){
             var o = json.results[i];
             if(o.answer==""){
               o.answer = "답변 대기중입니다.";
             }
             dom += '<img src="'+o.URL+'" style="width : 150px; height : 150px; margin : 0; padding:10px">'
                      +'<h4><label style="font-size:25px">'+o.productName+'</label></h4>'
                      +'<form name="item" action="qanAnswerWrite.php" method="post">'
                      +'<div class="read-title" style="text-align:left">'
                      +'<img style="margin:0; margin-bottom:8px;"src="../icon-64/qa.png">'
                      +'<span>&nbsp;'+o.userID+' 님의 질문입니다.</span></div>'
                      +'<input type="hidden" name="messengerID" value="'+o.messengerID+'">'
                      +'<div class="read-qna" style="text-align:left">'+o.messageContent+'</div>'
                      +'<div class="read-title" style="text-align:left">'
                      +'<img style="margin:0; margin-bottom:8px;"src="../icon-64/qa.png">'
                      +'<span>&nbsp;답변 작성</span></div>'
                      +'<textarea style="margin-top:10px" name="qcontents" cols=60 rows=10></textarea>'
                      +'<input class="btn btn-warning btn" type=submit value="답변 작성">'
                      +'</form>';
           }
           $('#click-before > div').empty().append(dom);
         }
       }
      });
      }
      </script>
    <div id="subnav"></div>

    <div class="alarm-contents">
      <div class="alarm-title">
          <span>1:1 질문 현황</span>
      </div>
        <!-- 주문 상품이 없다면? -->
        <?php
        include '../../../control/qna-controller.php';
        $answerArray = array();
        $mIDArray = array();
        $answerArray = getqnaList();
        $mIDArray = getmessengerIDList();
        $repeatNum = sizeof($answerArray);
        if($answerArray!=-1){
          echo "<div class=\"col-sm-4\">";
          $count=0;
          while($repeatNum>0){
            $title = $answerArray[$count];
            $mID = $mIDArray[$count];
            echo "<div class=\"designer-name\">";
            echo "<i class=\"icon\"><img src=\"../icon-64/user.png\"></i>";
            echo "<span style=\"cursor:pointer;\" onclick=\"answerDetail('$mID')\">$title</span>";
            //echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./answer-write.php?id=$mID'\">$title</span>";
            echo "</div>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
          echo "</div>";
          echo "<div id=\"click-before\"></div>";
        }else{
          echo "<div class=\"no-item\">";
          echo "<img src=\"../icon-64/alarm.png\">";
          echo "<p class=\"empty-msg\">질문이 없습니다.</p><br>";
          echo "</div>";
        }
        ?>
    </div>

  </div>
</div>
