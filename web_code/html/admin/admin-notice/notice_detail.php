<!DOCTYPE html>
<html lang="en">
<head>
  <title>UPCYCLOTHES MANAGER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}


    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;}
    }
  </style>
</head>

<script type="text/javascript">
  $(document).ready(function(){
    $("#header").load("../admin-header.php")
    $("#nav").load("../admin-nav.php")
  });
</script>

<body>

  <?php
    include '../../../../control/controller.php';
    if(checkAdmin()==false){
      echo("<script>location.replace('../admin-login.php');</script>");
    }
?>

<div id="header"></div>

<div class="container-fluid">
  <div class="row content">
    <div id="nav"></div>
    <br>

    <div class="col-sm-9">
      <div class="well">
        <h4>notice</h4>
        <?php
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $conn->set_charset('utf8');
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            //notice_list.php 에서 넘어온 글 번호 저장 및 출력
            $noticeID = $_GET["noticeID"];
            echo $noticeID."번째 글 내용<br>";
            //board 테이블에서 board_no값이 일치하는 board_no, board_title, board_content, board_user, board_date 필드 값 조회 쿼리
            $sql = "SELECT noticeID, subject, content, noticeImg, noticeType FROM Notice WHERE noticeID = '".$noticeID."'";
            $result = mysqli_query($conn,$sql);
            //조회 성공 여부 확인
            if($result) {
                echo "조회 성공";
            } else {
                echo "결과 없음: ".mysqli_error($conn);
            }
        ?>

        <table summary="공지사항 게시물 작성">
		<form name="BoardWriteForm">

   		<colgroup>
   			<col width="30%">
   			<col width="70%">
   		</colgroup>


		<table class="table table-bordered">
      <?php
          //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
          if($row = mysqli_fetch_array($result)) {
      ?>
		<caption>게시판 글쓰기</caption>
    		<tr>
				<td>제목</td>
				<td>  <?php
              echo $row["subject"];
          ?></td>
			</tr>
			<tr>
	 			<td>글 번호</td>
	 			<td><?php
            echo $row["noticeID"];
        ?></td>
    		</tr>
    		<tr>
     			<td>유형</td>
     			<td><?php echo $row["noticeType"];?></td>
    		</tr>
    		<tr>
     			<td>내 용</td>
     			<td><?php echo $row["content"];
                    echo $row["noticeImg"];?></td>
    		</tr>
     			<td colspan=2><hr size=1></td>
    		</tr>
    		<tr>
     			<td colspan="2"><div align="center">
         		<a class="btn btn-primary" href="./noticeManaging.php"> 리스트로 돌아가기</a></div>
     			</td>
    		</tr>
        <?php
            }
        ?>
		</table>
	</form>
</table>

      </div>
    </div>
  </div>
</div>

</body>
</html>
