<!--BooksテーブルとTypesテーブルを結合しました。
    ジャンルをTypesテーブルに登録しておけば、Booksテーブルに挿入する際に結合して表示できます-->

<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>SQL試作品</title>
    </head>
    
    <body>
    <?php
    $dsn = 'mysql:dbname=ーーー;host=localhost';
    $user = 'ーーー';
    $password = 'ーーー';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    
    //DBの内部結合でBooksとTypesを結合してジャンルを表示
    $sql = 'SELECT * FROM Books INNER JOIN Types ON Types.typeid=Books.type;';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //rowの添字[]にはテーブルのカラム名が入る
        echo $row['bookid'].',';
        echo $row['bookname'].',';
        echo $row['type'].',';
        echo $row['image'].'<br>';
    echo "<hr>";
    }