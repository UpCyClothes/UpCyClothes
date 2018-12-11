<?php
$ID = $_POST["ID"];
$Name = $_POST["Name"];
$designer = $_POST["designer"];
$category = $_POST["category"];
$price = $_POST["price"];
$URL = $_POST["URL"];
$content = $_POST["content"];
$quantity = $_POST["quantity"];
$originURL = $_POST["originURL"];
$opriginalcontentURL = &$_POST['opriginalcontentURL'];
$mysqli = mysqli_connect("localhost", "root", "316011","upcyclothes_db");
$mysqli->set_charset('utf8');
$categoryString = "";

if($mysqli) {
    echo "connect<br>";
} else {
    die("connect fail<br> : " .mysqli_error());
}


if($category==1){
  $categoryString = "clothes";
}else if($category==2){
  $categoryString = "bags";
}else if($category==3){
  $categoryString = "accessories";
}else if($category==4){
  $categoryString = "shoes";
}else if($category==5){
  $categoryString = "Jewelry";
}

$oldfile = '../..'.$originURL; // 원본파일
$olddetailfile = '../..'.$opriginalcontentURL; // 원본파일

//new file
$newfile =  '../../image/'.$categoryString.$URL;
$newdetailfile ='../../image/'.$categoryString.$content;

$andNewfile = '../../android/image/'.$categoryString.$URL;
$andNewdetailfile = '../../android/image/'.$categoryString.$content;

// 실제 존재하는 파일인지 체크...

if(file_exists($oldfile)) {
     if(!copy($oldfile, $newfile)) {
           echo "Fail to image copy1";
     }else if(file_exists($newfile)) {

     }
}else{
  echo "None";
}

if(file_exists($oldfile)) {
     if(!copy($oldfile, $andNewfile)) {
           echo "Fail to image copy2";
     }else if(file_exists($andNewfile)) {

     }
}else{
  echo "None";
}

if(file_exists($oldfile)) {
     if(!copy($oldfile, $newdetailfile)) {
           echo "Fail to image copy3";
     }else if(file_exists($newdetailfile)) {

     }
}else{
  echo "None";
}

if(file_exists($oldfile)) {
     if(!copy($oldfile, $andNewdetailfile)) {
           echo "Fail to image copy4";
     }else if(file_exists($andNewdetailfile)) {

     }
}else{
  echo "None";
}

//product 테이블의 productID값이 일치하는 행의 수정 값을 입력한 값으로,board_date값을 현재 시간으로 수정하는 쿼리
$URL = '/image/'.$categoryString.$URL;
$content = '/image/'.$categoryString.$content;

$sql = "INSERT into Product VALUES ('null','".$Name."','".$designer."','".$category."','".$price."','".$URL."','".$content."', '".$quantity."')";
$result = mysqli_query($mysqli,$sql);

$getIDsql = "SELECT productID from Product WHERE productName = '".$Name."'";
$result2 = mysqli_query($mysqli,$getIDsql);
$row = mysqli_fetch_array($result2);
$id = $row['productID'];
$newsql = "INSERT into NewItem VALUES ('".$id."','".$Name."','".$designer."','".$category."','".$price."','".$URL."','".$content."', '".$quantity."')";

$newresult = mysqli_query($mysqli, $newsql);
//수정 작업의 성공 여부 확인하기
if($result) {
    echo "register clear<br>: ".$result;

    $afterinsertsql = "DELETE FROM tempDB WHERE ID=".$ID."";
    //쿼리 실행 여부 확인
    if(mysqli_query($mysqli,$afterinsertsql)) {
        echo "delete clear<br>: ".$result; //과제 작성시 에러메시지 출력하게 만들기
    } else {
        echo "delete fail<br>: ".mysqli_error($mysqli);
    }

} else {
    echo "register fail<br>: ".mysqli_error($mysqli);
}

if($newresult){
  echo "success input to new Item : ".$newresult;
} else{
  echo "register to new Item fail : ".mysqli_error($mysqli);
}

mysqli_close($mysqli);

  //헤더를 이용한 리다이렉션 구현
header("Location: https://upcyclothes.duckdns.org/admin/admin-register/registerManaging.php");
?>
