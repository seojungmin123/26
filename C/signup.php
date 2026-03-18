<?php 
session_start();
include 'db.php';

$user_id = trim($_POST['user_id'] ?? '');
$password = trim($_POST['password'] ?? '');
$user_name = trim($_POST['user_name'] ?? '');

if(!$user_id || !$password || !$user_name){
    echo "<script>alert('모든 항목을 입력해주세요.'); history.back();</script>";
    exit;
}

$result = mysqli_query($conn, "select * from users where user_id = '$user_id'");
if (mysqli_num_rows($result)>0){
    echo "<script>alert('이미 사용중인 아이디입니다.'); history.back();</script>";
    exit;
}

mysqli_query($conn, "insert into users values('$user_id','$password','$user_name')");
echo "<script>alert('회원가입 성공'); location.href='index.php';</script>";
exit;
?>
