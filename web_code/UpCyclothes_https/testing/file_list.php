<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>업로드 파일 목록</title>
</head>
<body>
<h3>업로드 파일 목록</h3>
<table border="1">
<tr>
	<th>파일 아이디</th>
	<th>원래 파일명</th>
	<th>저장된 파일명</th>
</tr>
<tr>
	<th>
<?php
$db_conn = mysqli_connect("localhost", "root", "316011" ,"dokyeong");
$db_conn->set_charset('utf8');
$query = "SELECT file_id, name_orig, name_save FROM upload_file ORDER BY reg_time DESC";
$stmt = mysqli_prepare($db_conn, $query);
$exec = mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
echo $result;
while($row = mysqli_fetch_assoc($result)) {
		//echo "<a>'.$row['name_save'].'</a>";

}
//echo"<h3>파일 업로드 실패</h3>";
// mysqli_free_result($result);
// mysqli_stmt_close($stmt);
// mysqli_close($db_conn);
?>
</th>
</tr>
</table>
<a href="upload.php">업로드 페이지</a>
</body>
</html>
