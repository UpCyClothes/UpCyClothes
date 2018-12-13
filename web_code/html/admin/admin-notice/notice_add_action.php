<html>
    <head>
    </head>
    <body>
        <h1>noticeAddAction.php</h1>
        <?php
            //board_add_form.php 페이지에서 넘어온 글 번호값 저장 및 출력
            $noticeType = $_POST["noticeType"];
            $subject = $_POST["subject"];
            $content = $_POST["content"];
            $noticeImg = $_POST["noticeImg"];
            echo "noticeType : " . $noticeType . "<br>";
            echo "subject : " . $subject . "<br>";
            echo "content : " . $content . "<br>";
            echo "noticeImg : " . $noticeImg . "<br>";

            $updated = date("Ymd");

            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $conn->set_charset('utf8');
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            //board 테이블에 입력된 값을 1행에 넣고 board_date 필드에는 현재 시간을 입력하는 쿼리
            $sql = "INSERT INTO Notice (noticeType, subject, content, noticeImg, updated) values ('".$noticeType."','".$subject."','".$content."','".$noticeImg."','".$updated."')";

            $result = mysqli_query($conn,$sql);
            // 쿼리 실행 여부 확인
            if($result) {
                echo "입력 성공: ".$result; //과제 작성시 에러메시지 출력하게 만들기
            } else {
                echo "입력 실패: ".mysqli_error($conn);
            }
            mysqli_close($conn);
            //헤더함수를 이용하여 리스트 페이지로 리다이렉션
            header("Location: https://upcyclothes.duckdns.org/admin/admin-notice/noticeManaging.php"); //헤더 함수를 이용해서 리다이렉션 시킬 수 있다.
        ?>
    </body>
</html>
