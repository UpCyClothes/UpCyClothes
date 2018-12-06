<div id = contents>
  <div class="container">
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../mypage-sub-nav.php")
        $("#click-before").load("click-before.php")
      });

      function clickDesigner(designerName){
        $.ajax({
        url: 'titleListController.php',
        type: 'post',
        data: {
          'desingerID': designerName
        },
        async: false,
        success: function(data){
    		 if(data){
           // 데이터를 JSON으로 파싱
    			 var json = JSON.parse(data);
           var dom = '';

           for(i in json.results){
             var o = json.results[i];
             if(o.readmark==2){
               dom += '<div class="designer-name">' +
                         '<span style="cursor:pointer;" onclick="clickQNA('+o.messengerID+')">' +
                          o.messageTitle + '</span>' +
                          '<i style="float:right;" class="icon"><img style="margin:0" src="../icon-16/new.png"></i></div>';
             }else{
               dom += '<div class="designer-name">' +
                         '<span style="cursor:pointer;" onclick="clickQNA('+o.messengerID+')">' +
                          o.messageTitle + '</span></div>';
             }

           }
           $('#click-before > div').empty().append(dom);
    		 }
    	 }
      });
      }

      function clickQNA(messengerID){
        $.ajax({
        url: 'qnaClickController.php',
        type: 'post',
        data: {
          'messengerID': messengerID
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
                      +'<form name="item" action="qnaReadController.php" method="post">'
                      +'<div class="read-title" style="text-align:left">'
                      +'<img style="margin:0; margin-bottom:8px;"src="../icon-64/qa.png">'
                      +'<span>&nbsp;'+o.messageTitle+'</span></div>'
                      +'<input type="hidden" name="messengerID" value="'+o.messengerID+'">'
                      +'<div class="read-qna" style="text-align:left">'+o.messageContent+'</div>'
                      +'<div class="read-title" style="text-align:left">'
                      +'<img style="margin:0; margin-bottom:8px;"src="../icon-64/qa.png">'
                      +'<span>&nbsp;Designer의 답변</span></div>'
                      +'<div class="read-qna" style="text-align:left">'+o.answer+'</div><br>'
                      +'<input class="btn btn-warning btn"  type=submit value="답변 확인">'
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
        $designerArray = array();
        $designerArray = getDesignerNameList();
        $repeatNum = sizeof($designerArray);
        if($designerArray!=-1){
          echo "<div class=\"col-sm-4\">";
          $count=0;
          while($repeatNum>0){
            $designerName = $designerArray[$count];
            $isNew = isNewDesigner($designerName);
            echo "<div class=\"designer-name\">";
            echo "<i class=\"icon\"><img src=\"../icon-64/user.png\"></i>";
            //echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./messenger-detail.php?id=$designerName'\">$designerName</span>";
            echo "<span style=\"cursor:pointer;\" onclick=\"clickDesigner('$designerName')\">$designerName</span>";
            if($isNew==1){
              echo "<i style=\"float:right;margin-top:3px;\" class=\"icon\"><img src=\"../icon-16/new.png\"></i>";
            }
            echo "</div>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
          echo "</div>";
          echo "<div id=\"click-before\"></div>";
        }else{
          echo "<div class=\"no-item\">";
          echo "<img src=\"../icon-64/alarm.png\">";
          echo "<p class=\"empty-msg\">최근 1개월 이내의 QNA가 없습니다.</p><br>";
          echo "</div>";
        }
        ?>
    </div>

  </div>
</div>
