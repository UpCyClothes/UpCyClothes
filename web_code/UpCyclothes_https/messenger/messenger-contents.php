<div id = contents>
  <div class="container">
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../mypage-sub-nav.php")
        $("#click-before").load("click-before.php")
      });

      function clickDesigner(designerName){
//실패 시 지우면 됨.
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
    			 if(json.num_results > 1){

    				 alert(json.items[0].title);
    			 }else{
             console.log(json);
    			 }

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
            echo "<div class=\"designer-name\">";
            echo "<i class=\"icon\"><img src=\"../icon-64/user.png\"></i>";
            //echo "<span style=\"cursor:pointer;\" onclick=\"location.href='./messenger-detail.php?id=$designerName'\">$designerName</span>";
            echo "<span style=\"cursor:pointer;\" onclick=\"clickDesigner('$designerName')\">$designerName</span>";
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
