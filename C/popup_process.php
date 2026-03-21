<?php
session_start();
include 'db.php';

if($_SESSION['user_id'] !== 'admin'){
    echo "<script>alert('접근 권한이 없습니다.'); location.href='index.php';</script>";
    exit;
}

$action = $_POST['action'];

// 삭제
if($action === 'delete'){
    $id = $_POST['id'];
    mysqli_query($conn, "delete from popup where id=$id");
    echo "<script>alert('삭제되었습니다.'); location.href='popup.php';</script>";
    exit;
}

$title      = addslashes($_POST['title']);
$content    = addslashes($_POST['content']);
$start_date = $_POST['start_date'];
$end_date   = $_POST['end_date'];
$image = $_POST['current_image'] ?? '';

// 이미지 업로드
if($_FILES['image']['name']){
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $filename = time().'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$filename);
    $image = $filename;
}

// 등록
if($action === 'insert'){
    mysqli_query($conn, "insert into popup (title, content, image, start_date, end_date) values ('$title','$content','$image','$start_date','$end_date')");
    echo "<script>alert('등록되었습니다.'); location.href='popup.php';</script>";
}

// 수정
if($action === 'update'){
    $id = $_POST['id'];
    mysqli_query($conn, "update popup set title='$title', content='$content', image='$image', start_date='$start_date', end_date='$end_date' where id=$id");
    echo "<script>alert('수정되었습니다.'); location.href='popup.php';</script>";
}
exit;
?>