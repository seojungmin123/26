<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>열람실예약</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="intro.css">
    <style>
        .section-inner{
            p{text-align: center;}
            .seat-wrap {
                display: grid;
                grid-template-columns: repeat(15, 1fr);
                gap: 0.5em;
                text-align: center;
                max-width: 1000px;
                margin: 1.5em auto;

                .seat {
                    padding: 1em;
                    background: var(--white);
                    text-align: center;
                    cursor: pointer;
                    border-radius: 6px;
                    font-size: 0.9em;
                    position: relative;
                    user-select: none;
                    &:hover{ background: var(--cream); }
                    &:hover .tooltip { display: block; }

                    .tooltip {
                        display: none;
                        position: absolute;
                        bottom: 110%;
                        left: 50%;
                        transform: translateX(-50%);
                        background: var(--dark);
                        color: #fff;
                        padding: 0.5em 1em;
                        border-radius: 6px;
                        white-space: nowrap;
                    }
                }
                .selected { background: var(--accent); color: #fff; }
            }
            .reserve-form {
                max-width: 400px;
                margin: 3em auto;
                display: none;
                flex-direction: column;
                gap: 0.8em;

                input {
                    padding: 1em;
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
            .show { display: flex; }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<section id="intro-top">
    <img src="images/images (9).png" alt="">
    <h2>열람실 예약</h2>
</section>

<?php
$today = date('Y-m-d');
$result = mysqli_query($conn, "select * from reservation where reserve_date >= '$today' order by reserve_date asc, start_time asc");
$reservations = [];
while($row = mysqli_fetch_assoc($result)){
    $reservations[] = $row;
}
?>

<section id="reserve">
    <h2 class="section-title">열람실 예약</h2>
    <div class="section-inner">
        <p>좌석을 클릭하거나 드래그하여 최대 4석까지 선택하세요.</p>

        <div class="seat-wrap">
            <?php for($i = 1; $i <= 75; $i++): ?>
                <?php $seatRes = array_filter($reservations, fn($r) => $r['seat_no'] == $i); ?>

                <div class="seat" data-seat="<?= $i ?>">
                    <?= $i ?>
                    <div class="tooltip">
                        <?php if($seatRes): ?>
                            <?php foreach($seatRes as $r): ?>
                                <div><?= $r['reserve_date'] ?> <?= $r['start_time'] ?>~<?= $r['end_time'] ?></div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            예약없음
                        <?php endif; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

        <p>선택된 좌석: <strong class="selected-info">없음</strong></p>

        <form action="reserve_process.php" method="post" class="reserve-form">
            <input type="hidden" name="seats" class="seats-input">
            <h3>예약 정보 입력</h3>
            <label>예약일</label>
            <input type="date" name="reserve_date" class="reserve-date" min="<?= $today ?>">
            <label>시작시간</label>
            <input type="time" name="start_time">
            <label>종료시간</label>
            <input type="time" name="end_time">
            <button type="submit">예약하기</button>
        </form>
    </div>
</section>
<?php include 'footer.php'; ?>

<script>
let selected = [];
let isDragging = false;

document.querySelectorAll('.seat').forEach(seat => {
    seat.addEventListener('mousedown', (e) => {
        e.preventDefault();
        isDragging = true;
        toggleSeat(seat);
    });
    seat.addEventListener('mouseover', () => { 
        if(isDragging && !seat.classList.contains('selected') && selected.length < 4) toggleSeat(seat); 
    });
});

document.addEventListener('mouseup', () => isDragging = false);

function toggleSeat(seat) {
    const no = parseInt(seat.dataset.seat);
    if(seat.classList.contains('selected')) {
        seat.classList.remove('selected');
        selected = selected.filter(s => s !== no);
    } else {
        if(selected.length >= 4) { alert('최대 4석까지 선택 가능합니다.'); return; }
        seat.classList.add('selected');
        selected.push(no);
    }

    document.querySelector('.selected-info').textContent = selected.length ? selected.join(', ')+'번' : '없음';

    document.querySelector('.reserve-form').classList.toggle('show', selected.length > 0);

    document.querySelector('.seats-input').value = JSON.stringify(selected);
}
</script>
</body>
</html>