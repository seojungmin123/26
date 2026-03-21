<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>스킬스북도서관</title>
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
        .minus { color:red; }
        .btn-return {
            padding:0.4em 1em;
            background:transparent;
            border:1px solid var(--accent);
            color:var(--accent);
            border-radius:8px;
            cursor:pointer;
            transition:0.2s;
            &:hover { background:var(--accent); color:#fff; }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<?php
    if(!isset($_SESSION['user_id'])){
        echo "<script>alert('로그인이 필요합니다.'); location.href='index.php';</script>";
        exit;
    }
?>

<section id="intro-top">
    <img src="images/images (42).jpg" alt="">
    <h2>마이페이지</h2>
</section>

<section>
    <h2 class="section-title">대출 현황</h2>
    <div class="section-inner">
        <?php
            $today = date('Y-m-d');
            $loans = mysqli_query($conn, "select l.*, b.title, b.author, b.image from loan l left join books b ON l.book_id = b.id where l.user_id = '{$_SESSION['user_id']}'");
        ?>
        <table>
            <tr>
                <th>도서사진</th>
                <th>도서명</th>
                <th>저자명</th>
                <th>대출일자</th>
                <th>반납일</th>
                <th>남은기간</th>
                <th>반납</th>
            </tr>
            <?php while($loan = mysqli_fetch_assoc($loans)): ?>
                <?php $diff = (int)((strtotime($loan['return_date']) - strtotime($today)) / 86400); ?>
                <tr>
                    <td><img src="images/<?= $loan['image'] ?>"></td>
                    <td style="white-space: normal;"><?= $loan['title'] ?></td>
                    <td style="white-space: normal;"><?= $loan['author'] ?></td>
                    <td><?= $loan['loan_date'] ?></td>
                    <td><?= $loan['return_date'] ?></td>
                    <td class="<?= $diff < 0 ? 'minus' : '' ?>"><?= $diff ?>일</td>
                    <td>
                        <form action="return_process.php" method="post">
                            <input type="hidden" name="loan_id" value="<?= $loan['id'] ?>">
                            <input type="hidden" name="book_id" value="<?= $loan['book_id'] ?>">
                            <button class="btn-return" type="submit">반납</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>

<section>
    <h2 class="section-title">열람실 예약 현황</h2>
    <div class="section-inner">
        <?php $reserves = mysqli_query($conn, "select * from reservation where user_id = '{$_SESSION['user_id']}' and (reserve_date > '$today' or (reserve_date = '$today' and end_time > NOW())) order by reserve_date asc"); ?>
        <table>
            <tr>
                <th>좌석번호</th>
                <th>예약일</th>
                <th>시작시간</th>
                <th>종료시간</th>
                <th>예약자 아이디</th>
            </tr>
            <?php while($r = mysqli_fetch_assoc($reserves)): ?>
                <tr>
                    <td><?= $r['seat_no'] ?></td>
                    <td><?= $r['reserve_date'] ?></td>
                    <td><?= $r['start_time'] ?></td>
                    <td><?= $r['end_time'] ?></td>
                    <td><?= $r['user_id'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>