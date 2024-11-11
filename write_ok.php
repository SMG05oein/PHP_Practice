<?php
include $_SERVER["DOCUMENT_ROOT"]."/setDB.php";

// echo "<pre>";
// print_r($_POST);

$subject=$_POST["subject"];
$content=$_POST["content"];
$userid="홍길동";//userid는 없어서 임의로 넣어줬다.
$status=1;//status는 1이면 true, 0이면 false이다.

// echo "<br>------<br>";

// echo "제목=>".$subject."<br>";
// echo "내용=>".$content;

$sql="insert into board (userid,subject,content) values ('".$userid."','".$subject."','".$content."')";
$result=$mysqli->query($sql) or die($mysqli->error);

header("Location: index.php");  // index.php로 리다이렉트
exit(); // 리다이렉트 후 코드 실행 종료
//echo "결과=>".$result;


?>
