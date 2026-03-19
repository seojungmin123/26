<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('로그인이 필요합니다.'); history.back();</script>";
    exit;
}

$seats = json_decode($_POST['seats'], true);
$reserve_date  = $_POST['reserve_date'];
$start_time = $_POST['start_time'];
$end_time   = $_POST['end_time'];
$user_id = $_SESSION['user_id'];

if(!$seats || !$reserve_date || !$start_time || !$end_time){
    echo "<script>alert('모든 항목을 입력해주세요.'); history.back();</script>";
    exit;
}

if($start_time >= $end_time){
    echo "<script>alert('종료시간은 시작시간보다 늦어야 합니다.'); history.back();</script>";
    exit;
}

// 중복 체크
foreach($seats as $seat_no){
    $result = mysqli_query($conn, "select * from reservation where seat_no=$seat_no and reserve_date='$reserve_date' and not (end_time <= '$start_time' or start_time >= '$end_time')");
    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('{$seat_no}번 좌석은 해당 시간에 이미 예약되어 있습니다.'); history.back();</script>";
        exit;
    }
}

// 예약 등록
foreach($seats as $seat_no){
    mysqli_query($conn,"insert into reservation (user_id, seat_no, reserve_date, start_time, end_time)values ('$user_id', $seat_no, '$reserve_date', '$start_time', '$end_time')");
}

echo "<script>alert('예약이 완료되었습니다.'); location.href='reserve.php';</script>";
exit;
?>