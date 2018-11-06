<div id = contents>

  <div class="container" style="text-align: center;">
    <div class="contentstitle"> <p>< BAG ></p></div>
    <hr width = "100%" style="border: solid 1px; color: #808080 ">
    <div class="row">
      <?php
      include '../../../control/contents-controller.php';
      $array = getproduct(2);
      $repeatNum = sizeof($array);
      $count=0;
        while($repeatNum>0){
          $productName = boardName($array[$count]);
          $productPrice = boardPrice($array[$count]);
          $url = "../";
          $c = $url.getthumbnail($array[$count]);
          if($repeatNum%4==0){
              echo "<div class=\"row\">";
          }
          $p_id = $array[$count];
          echo "<div class=\"col-md-4\">";
          echo "<div class=\"thumbnail\">";
          echo "<a href=\"../detail-board.php?id=$p_id\">";
          echo "<img src=\"$c\" alt=\"Lights\" style=\"width:100%\">";
          echo "<div class=\"caption\" style=\"text-align:center\">";
          echo "<p>$productName</p>";
          echo "<p> $productPrice 원</p>";
          echo "</div>";
          echo "</a>";
          echo "</div>";
          echo "</div>";
          if($repeatNum%4==0){
              echo "</div>";
          }
          $repeatNum = $repeatNum-1;
          $count = $count+1;
        }
      ?>
    </div>

    <!-- 페이지 하단 번호 -->
    <ul class="pagination">
      <li><a href="#"><<</a></li>

      <li><a href="#">1</a></li>

      <li><a href="#">>></a></li>
      <!-- <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li> -->
    </ul>
  </div>

</div>
