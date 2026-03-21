<?php 
include '../db.php';

$books = json_decode(file_get_contents('../도서정보.json'), true);

foreach($books as $book){
    $title = addslashes($book['서명']);
    $author = addslashes($book['저자']);
    $image = $book['이미지'];
    $pub_year = $book['발행년'];
    $price = $book['가격'];

    mysqli_query($conn, "insert into books (title, author, image, pub_year, price) values ('$title','$author','$image','$pub_year','$price')");
}
?>