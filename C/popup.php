<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>팝업관리</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="intro.css">
    <style>
        table { 
            width:100%;
            border-collapse:collapse;
        }
        th, td { 
            padding:0.8em;
            border:1px solid var(--cream);
            text-align:center;
            white-space: nowrap;
            img{
                width: 8em;
                height: 10em;
                object-fit: cover;
            }
        }
        th { background:var(--dark); color:var(--white); }
        tr:hover { background:var(--bg-section); }
        .btn{
            padding:0.4em 1em;
            background:transparent;
            border:1px solid var(--accent);
            color:var(--accent);
            border-radius:8px;
            cursor:pointer;
            transition:0.2s;
            &:hover { background:var(--accent); color:#fff; }
        }

        form{
            max-width: 600px;
            label { font-weight: bold; color: var(--dark); }
            input,textarea{
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

$today = date('Y-m-d');
$popups = mysqli_query($conn, "select * from popup order by start_date");
?>

<section id="intro-top">
    <img src="images/images (42).jpg" alt="">
    <h2>팝업관리</h2>
</section>

<section>
    <h2 class="section-title">팝업 목록</h2>
    <div class="section-inner">
        <table>
            <tr>
                <th>제목</th>
                <th>시작일</th>
                <th>종료일</th>
                <th>수정</th>
                <th>삭제</th>
            </tr>
            <?php while($popup = mysqli_fetch_assoc($popups)): ?>
                <tr>
                    <td><?= $popup['title'] ?></td>
                    <td><?= $popup['start_date'] ?></td>
                    <td><?= $popup['end_date'] ?></td>
                    <td>
                        <a href="popup.php?edit=<?= $popup['id'] ?>">
                            <button class="btn">수정</button>
                        </a>
                    </td>
                    <td>
                        <form action="popup_process.php" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $popup['id'] ?>">
                            <button class="btn" type="submit">삭제</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>

<section>
    <?php
    $edit = null;
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $result = mysqli_query($conn, "select * from popup where id=$id");
        $edit = mysqli_fetch_assoc($result);
    }
    ?>
    <h2 class="section-title"><?= $edit ? '팝업 수정' : '팝업 등록' ?></h2>
    <div class="section-inner">
        <form action="popup_process.php" method="post" enctype="multipart/form-data" class="f-c gap-1 m0a">
            <input type="hidden" name="action" value="<?= $edit ? 'update' : 'insert' ?>">

            <?php if($edit): ?>
                <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                <input type="hidden" name="current_image" value="<?= $edit['image'] ?>">
            <?php endif; ?>

            <label>제목</label>
            <input type="text" name="title" value="<?= $edit['title'] ?? '' ?>" required>
            <label>내용</label>
            <textarea name="content" rows="4"><?= $edit['content'] ?? '' ?></textarea>
            <label>이미지 (JPG, JPEG, PNG)</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">
            <label>팝업시작일</label>
            <input type="date" name="start_date" value="<?= $edit['start_date'] ?? '' ?>" required>
            <label>팝업종료일</label>
            <input type="date" name="end_date" value="<?= $edit['end_date'] ?? '' ?>" required>
            
            <button class="btn-submit" type="submit"><?= $edit ? '수정하기' : '등록하기' ?></button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>