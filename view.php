<?php
include $_SERVER['DOCUMENT_ROOT'].'/setDB.php';

$mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);
if ($mysqli->connect_errno) {
    die('Connect Error: '.$mysqli->connect_error);
}

//$bid = $_GET['bid'];
//$result = $mysqli->query("select * from board where bid = ".$bid) or die("query error => ".$mysqli->error);
//$rs = $result->fetch_object();
//
//echo "<pre>";
//print_r($rs);

// bid 값이 있는지 확인하고, 정수형으로 변환하여 유효성 검사
$bid = isset($_GET['bid']) ? intval($_GET['bid']) : 0;
if ($bid <= 0) {
    die("유효하지 않은 bid 값입니다.");
}

// Prepared Statement를 사용하여 SQL 쿼리를 안전하게 실행
$stmt = $mysqli->prepare("SELECT * FROM board WHERE bid = ?");
if (!$stmt) {
    die("Prepare failed: ".$mysqli->error);
}

$stmt->bind_param("i", $bid);  // 정수형으로 바인딩
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("해당 bid에 대한 게시물이 없습니다.");
}

$rs = $result->fetch_object();

//echo "<pre>";
//print_r($rs);

?>

<!doctype html>
<html lang="ko">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>게시판 보기</title>
</head>
<body>


<div class="col-md-8" style="margin:auto;padding:20px;">
    <h3 class="pb-4 mb-4 fst-italic border-bottom" style="text-align:center;">
        - 게시판 보기 -
    </h3>

    <article class="blog-post">
        <h2 class="blog-post-title"><?php echo $rs->subject;?></h2>
        <p class="blog-post-meta"><?php echo $rs->regdate;?> by <a href="#"><?php echo $rs->userid;?></a></p>

        <hr>
        <p>
            <?php echo $rs->content;?>
        </p>
        <hr>
    </article>

    <nav class="blog-pagination" aria-label="Pagination">
        <a class="btn btn-outline-primary" href="/PHP_Practice/index.php">목록</a>
        <!-- <a class="btn btn-outline-secondary" href="#">답글</a> -->
    </nav>

</div>

</body>
</html>