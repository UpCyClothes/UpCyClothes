<div id="contents">
<div class="container" >
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../board-sub-nav.php")
      });
      </script>
    <div id="subnav"></div>
    <div class="notice-contents" style="height:600px">
      <div class="notice-title">Weekly 디자이너</div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th style="width:70%">제목</th>
            <th style="width:15%">작성자</th>
            <th style="width:15%">날짜</th>
          </tr>
        </thead>
          <tbody>
            <!--공지사항 게시물 php 작성 Part-->
            <?php
            include '../../../control/board-controller.php';
            $boardArray = getBoardCount(3);
            $repeatNum = sizeof($boardArray);
            $count=0;
            while($repeatNum>0){
              $p_id = $boardArray[$count];
              $boardTitle = getBoardTitle($p_id);
              $boardWriter = getBoardWriter();
              $boardDate = getBoardDate($p_id);
              echo "<td onClick=\"location.href='weekly-designer-detail-board.php?id=$p_id'\"  style=\"cursor:pointer;\">$boardTitle</td>";
              echo "<td>$boardWriter</td>";
              echo "<td>$boardDate</td>";
              $repeatNum = $repeatNum-1;
              $count = $count+1;
            }
             ?>

          </tbody>
      </table>
    </div>
      <!-- 공지 내용 -->
</div>
</div>
