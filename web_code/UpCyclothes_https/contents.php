<div id = contents>
  <div class="container" >

      <!-- http://dokyeong.dothome.co.kr/ -->
      <div style="width:auto; height:auto; text-align:center">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <div class="item active">
                <!-- <img src="./site_1.jpg" alt="Los Angeles" style="width:100%;"> -->
                <img src="image/main1.jpg" alt="image">
              </div>

              <div class="item">
                <img src="image/main2.jpg" alt="image" >
                <!-- <img src="./site_2.jpg" alt="Los Angeles" style="width:100%;"> -->
              </div>

              <div class="item">
                <img src="image/main3.jpg" alt="image" >
                <!-- <img src="./site_3.jpg" alt="Los Angeles" style="width:100%;"> -->
              </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
          </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
          </a>
      </div>
      </div>
  <br>
  </div>
  <div class="container">
    <h4 style="text-align:center;   font-weight: bold;  font-size: 35px;">This Week New Item</h4>
    <br>
    <div class="row">
      <?php
      include '../../control/contents-controller.php';
      $array = getNewProduct();
      $repeatNum = sizeof($array);
      $count=0;
      if($repeatNum==0){
          echo "<p>새로운 Item이 없습니다.</p>";
      }else{
        echo "<div class=\"row\">";
          while($repeatNum>0){
            $productName = newBoardName($array[$count]);
            $productPrice = newBoardPrice($array[$count]);
            $url = "../";
            $c = $url.getNewthumbnail($array[$count]);
            $p_id = $array[$count];
            echo "<div class=\"col-md-4\">";
            echo "<div class=\"thumbnail\">";
            echo "<a href=\"detail-board.php?id=$p_id\">";
            echo "<img src=\"$c\" alt=\"Lights\" style=\"width:100%\">";
            echo "<div class=\"caption\" style=\"text-align:center\">";
            echo "<p>$productName</p>";
            echo "<p> $productPrice 원</p>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
            echo "</div>";
            $repeatNum = $repeatNum-1;
            $count = $count+1;
          }
        echo "</div>";
      }
      ?>
    </div>
  </div>
</div>
