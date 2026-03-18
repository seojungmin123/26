<?php 
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('로그인이 필요합니다.'); history.back();</script>";
    exit;
}

$book_id = $_POST['book_id'];
$user_id = $_SESSION['user_id'];
$loan_date = date('y-m-d');
$return_date = date('y-m-d',strtotime('+9 days'));

mysqli_query($conn,"insert into loan (user_id,book_id,loan_date,return_date) values ('$user_id','$book_id','$loan_date','$return_date')");
mysqli_query($conn,"update books set status = 'N' where id = '$book_id'");

echo "<script>alert('대출완료! 반납일: $return_date'); location.href='library.php';</script>";
exit;
?>