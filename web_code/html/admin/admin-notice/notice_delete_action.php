<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>notice_delete.php</title>
    </head>
    <body>
        <h1>notice_delete_action.php</h1>
        <?php
            //board_delete_form.php 페이지에서 넘어온 글 번호값 저장 및 출력
            $noticeID = $_POST["noticeID"];
            $adminpw = $_POST["adminpw"];
            echo "noticeID : " . $noticeID . "<br>";
            echo "adminpw : " . $adminpw . "<br>";
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_connect_error());
            }
            //board테이블에서 입력된 글 번호와, 글 비밀번호가 일치하는 행 삭제 쿼리
            $sql = "DELETE FROM Notice WHERE noticeID=".$noticeID."";
            //쿼리 실행 여부 확인
            if(mysqli_query($conn,$sql)) {
                echo "삭제 성공: ".$result; //과제 작성시 에러메시지 출력하게 만들기
            } else {
                echo "삭제 실패: ".mysqli_error($conn);
            }

            mysqli_close($conn);
            //헤더함수를 이용하여 리스트 페이지로 리다이렉션
            header("Location: https://upcyclothes.duckdns.org/admin/admin-notice/noticeManaging.php");
        ?>
    </body
</html>
