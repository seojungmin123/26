<?php
session_start();
include 'db.php';

$loan_id = $_POST['loan_id'];
$book_id = $_POST['book_id'];
$redirect = $_POST['redirect'] ?? 'mypage.php';

mysqli_query($conn, "delete from loan where id = $loan_id");

mysqli_query($conn, "update books set status='Y' where id=$book_id");

echo "<script>alert('반납이 완료되었습니다.'); location.href='$redirect';</script>";
exit;
?>