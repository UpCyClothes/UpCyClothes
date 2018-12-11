<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>order_update.php</title>
    </head>
    <body>
        <h1>order_update_action.php</h1>
        <?php
            //board_update_form.php에서 POST 방식으로 넘어온 값 저장 및 출력
            $orderID = $_POST["orderID"];
            // $productID = $_POST["productID"];
            // $userID = $_POST["userID"];
            $orderState = $_POST["orderState"];

            echo "orderID : " . $orderID . "<br>";
            // echo "productID : " . $productID . "<br>";
            // echo "userID : " . $userID . "<br>";
            echo "orderState : " . $orderState . "<br>";

            //커넥션 객체 생성 및 연결 여부 확인하기
            $conn = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
            $conn->set_charset('utf8');

            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            //board 테이블의 board_no값이 일치하는 행의 board_title,board_content 값을 입력한 값으로,board_date값을 현재 시간으로 수정하는 쿼리
            $sql = "UPDATE orderList SET orderState='".$orderState."' WHERE orderID=".$orderID."";
            $result = mysqli_query($conn,$sql);
            //수정 작업의 성공 여부 확인하기
            if($result) {
                echo "수정 성공: ".$result;
            } else {
                echo "수정 실패: ".mysqli_error($conn);
            }

            mysqli_close($conn);
            //헤더를 이용한 리다이렉션 구현
            header("Location: https://upcyclothes.duckdns.org/admin/admin-order/orderManaging.php");
        ?>
    </body>
</html>
