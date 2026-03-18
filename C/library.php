<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>스킬스북도서관</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="intro.css">
    
    <style>
        .container{
            display: grid;
            grid-template-columns: repeat(5,1fr);
            gap: 1em;
            > div{
                background: #fff;
                border-radius: 10px;
                border: 1px solid var(--mustard);
                transition: 0.3s;
                padding: 1em;
                display: flex;
                flex-direction: column;
                &:hover{
                    transform: translateY(-0.5em)
                }

                img{
                    width: 100%;
                    height: 12em;
                    display: inline-block;
                    object-fit: cover;
                    text-align: center;
                    align-content: center;
                }

                p{
                    margin-bottom: 0.4em;
                }
                .book-title{
                    font-size: 1.1em;
                    font-weight: bold;
                    color: var(--black);
                }
                .book-author{
                    font-size: 0.9em;
                    color: var(--accent);
                }
                .book-meta{
                    font-size: 0.9em;
                    color: var(--mustard);
                }
                span{
                    width: 5em;
                    text-align: center;
                    align-content: center;
                    font-size: 0.8em;
                    padding: 0.3em 0.5em;
                    margin-bottom: 1em;
                    border-radius: 10px;
                    color: var(--dark);
                }
                .y{background: rgba(115, 185, 115, 0.2); color: rgb(115, 185, 115);}
                .n{background-color: var(--cream); color: var(--accent);}
                button{
                    width: 100%;
                    padding: 0.5em;
                    border-radius: 10px;
                    transition: 0.2s;
                    border: 1px solid var(--accent);
                    margin-top: auto;
                }
                .btn-loan{
                    background: transparent; color: var(--accent);
                    &:hover{
                        background-color:var(--accent); color:#fff;
                    }
                }
                .btn-disabled{background: #f5f5f5; border: 1px solid #ccc; color: #aaa; cursor: not-allowed;}
                form{margin-top: auto;}
            }
        }
        
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <section id="intro-top">
        <img src="images/images (41).jpg" alt="">
        <h2>도서자료실</h2>
    </section>

    <section id="library">
        <h2 class="section-title">도서대출</h2>
        <div class="section-inner">
            <div class="container">
                <?php 
                    $books = mysqli_query($conn, "select b.*,l.loan_date, l.return_date from books b left join loan l on b.id = l.book_id order by b.id");
                    while($book = mysqli_fetch_assoc($books)):
                ?>
                    <div>
                        <img src="<?= $book['image'] ?>" alt="<?= $book['image'] ?>">
                        <p class="book-title"><?= $book['title'] ?></p>
                        <p class="book-author"><?= $book['author'] ?></p>
                        <p class="book-meta"><?= $book['pub_year'] ?> &middot; <?= $book['price'] ?> 원</p>
                        <?php if($book['status'] === 'Y'):?>
                            <span class="status y">대출가능</span>
                            <form action="loan_process.php" method="post">
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                <button class="btn-loan" onclick="loan(<?= $book['id'] ?>)">대출하기</button>
                            </form>
                        <?php else:?>
                            <div><span class="status n">대출중</span><span><?= $book['loan_date'] ?> ~ <?= $book['return_date'] ?></span></div>
                            <button class="btn-disabled">대출중</button>
                        <?php endif;?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    
    <?php include 'footer.php'; ?>
</body>
</html>