<?php
session_start();
include 'db.php';

$reserve_id = $_POST['reserve_id'];
mysqli_query($conn, "delete from reservation where id=$reserve_id");

echo "<script>alert('예약이 취소되었습니다.'); location.href='check.php';</script>";
exit;
?>