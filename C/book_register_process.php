<?php
session_start();
include 'db.php';

if($_SESSION['user_id'] !== 'admin'){
    echo "<script>alert('접근 권한이 없습니다.'); location.href='index.php';</script>";
    exit;
}

$title     = addslashes($_POST['title']);
$author    = addslashes($_POST['author']);
$publisher = addslashes($_POST['publisher']);
$pub_year  = $_POST['pub_year'];
$price     = $_POST['price'];

$image = '';

if($_FILES['image']['name']){
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    
    if(!in_array($ext, ['jpg','jpeg','png'])){
        echo "<script>alert('JPG, JPEG, PNG 파일만 업로드 가능합니다.'); history.back();</script>";
        exit;
    }
    
    $filename = time().'.'.$ext;
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$filename);
    $image = $filename;
}

mysqli_query($conn, "insert into books (title, author, publisher, pub_year, price, image) values ('$title','$author','$publisher',$pub_year,$price,'$image')");

echo "<script>alert('도서가 등록되었습니다.'); location.href='book_register.php';</script>";
exit;
?>