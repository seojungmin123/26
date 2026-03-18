<?php 
session_start();
include 'db.php';

$user_id = trim($_POST['user_id'] ?? '');
$password = trim($_POST['password'] ?? '');

$result = mysqli_query($conn, "select * from users where user_id='$user_id'");

if(mysqli_num_rows($result)>0){
    $user = mysqli_fetch_assoc($result);

    if($user['password']===$_POST['password']){
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        echo "<script>location.href='index.php';</script>";
        exit;
    }else{
        echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.'); history.back();</script>";
        exit;
    }
} else{
    echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.'); history.back();</script>";
    exit;
}
?>