<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>신규도서등록</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="intro.css">
    <style>
        form{
            max-width: 600px;
            label { font-weight: bold; color: var(--dark); }
            input {
                width: 100%;
                padding: 0.8em;
                border: 1px solid var(--cream);
                border-radius: 8px;
            }
            button {
                padding: 1em;
                background: var(--accent);
                color: #fff;
                border: none;
                border-radius: 8px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<?php
if($_SESSION['user_id'] !== 'admin'){
    echo "<script>alert('접근 권한이 없습니다.'); location.href='index.php';</script>";
    exit;
}
?>

<section id="intro-top">
    <img src="images/images (41).jpg" alt="">
    <h2>신규도서등록</h2>
</section>

<section>
    <h2 class="section-title">신규도서등록</h2>
    <div class="section-inner">
        <form action="book_register_process.php" method="post" enctype="multipart/form-data" class="f-c gap-1 m0a">
            <label>도서명</label>
            <input type="text" name="title" required>
            <label>저자명</label>
            <input type="text" name="author" required>
            <label>출판사</label>
            <input type="text" name="publisher">
            <label>도서사진 (JPG, JPEG, PNG)</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">
            <label>발행년</label>
            <input type="number" name="pub_year" required>
            <label>가격</label>
            <input type="number" name="price" required>
            <button type="submit">등록하기</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>