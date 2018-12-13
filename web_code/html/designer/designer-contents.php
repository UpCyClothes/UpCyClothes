<div id = contents>

  <div class="container" style="text-align: center;">
    <div class="contentstitle"> <p>< MATERIAL ></p></div>
    <hr width = "100%" style="border: solid 1px; color: #808080 ">
    <div class="row">
      <?php
      include '../../../control/material-controller.php';
      $array = getMaterailName();
      $image_array = getMaterailURL();

      $repeatNum = sizeof($array);

      $count=0;

        while($repeatNum>0){
          $p_id = $array[$count];
          $i_id = $image_array[$count];

          $url = "../";
          $c = $url.$i_id;
          $prim = $count+1;
          if($repeatNum%4==0){
              echo "<div class=\"row\">";
          }

          echo "<div class=\"col-md-4\">";
          echo "<div class=\"thumbnail\">";
          echo "<a href=\"designer-detail-board.php?id=$prim\">";
          echo "<img src=\"$c\" alt=\"Lights\" style=\"width:100%\">";
          echo "<div class=\"caption\" style=\"text-align:center\">";
          echo "<p>$p_id</p>";
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
    </ul>
  </div>

</div>
