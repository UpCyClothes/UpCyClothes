<!DOCTYPE html>
<html lang="en">
<head>
  <title>UpCyclothes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="../index-style.css"> -->
  <link rel="stylesheet" href="market-style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#topnav").load("../topnav.php")
       $("#header").load("../header.php")
       $("#contents").load("clothes-contents.php")
       $("#footer").load("../footer.html")
    });
</script>
</head>
<body>
  <?php
      include '../../../control/controller.php';
      if(checkLogin()==true){
        echo "<div id=\"topnav_login\"></div>";
      }else{
        echo "<div id=\"topnav\"></div>";
      }
      //echo "<td><input type='button' value='LOGIN' class='topbutton' onclick=\"location.href='".$URL."';\">";
  ?>
  <div id="header"></div>
  <div id="contents"></div>
  <div id="footer"></div>
</body>
</html>
