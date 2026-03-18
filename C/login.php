<?php 
session_start();
include 'db.php';

$userid = trim($_POST['userid'] ?? '');
$password = trim($_POST['password'] ?? '');

$result = mysqli_query($conn, "select * from users where userid='$userid'");

if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);
    if($userid !== $user['userid'])
}else{
    echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.')</script>";
}
?>