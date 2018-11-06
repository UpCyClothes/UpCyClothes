<div id="contents">
<div class="container" >
    <script type="text/javascript">
      $(document).ready(function(){
        $("#subnav").load("../board-sub-nav.php")
      });
      </script>
    <div id="subnav"></div>
    <div class="notice-contents">
      <div class="notice-title">공지사항</div>
      <!-- 공지 내용 -->
      <?php // TODO: Array로 옮겨서 데이터 다시 받아오기.?>
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
                  $boardArray = getBoardCount(1);
                  $repeatNum = sizeof($boardArray);
                  $count=0;
                  while($repeatNum>0){
                    $p_id = $boardArray[$count];
                    $boardTitle = getBoardTitle($p_id);
                    $boardWriter = getBoardWriter();
                    $boardDate = getBoardDate($p_id);
                    echo "<tr>";
                    echo "<td onClick=\"location.href='notice-detail-board.php?id=$p_id'\" style=\"cursor:pointer;\">$boardTitle</td>";
                    echo "<td>$boardWriter</td>";
                    echo "<td>$boardDate</td>";
                    echo "</tr>";
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
