<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>SQL試作品</title>
    </head>
    
    <body>
    <?php
    $dsn = 'mysql:ーーーb;host=localhost';
    $user = 'ーーー';
    $password = 'ーーー';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    
    
    //本の感想を書くテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Bookreviews" 
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "bookid int," //本を登録してもらう時に自動で発行されるidを入力してもらう？
    . "userid int," //会員登録の時にidを登録してもらい、それで会員を判別？
    . "review int," //五段階評価？
    . "comment TEXT,"
    . "readdata TEXT" //入力した時の日付が入るようにdate関数を使う？
    .");";
    $stmt = $pdo->query($sql);
    
    
    
    //本を登録するテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Books" 
    ." ("
    . "bookid INT AUTO_INCREMENT PRIMARY KEY,"
    . "bookname TEXT,"
    . "type int,"  //ジャンル（typeidを登録→後に結合）
    . "image mediumblob"  //画像を登録
    .");";
    $stmt = $pdo->query($sql);
    
    
    //ジャンルを登録するテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Types" 
    ." ("
    . "typeid INT AUTO_INCREMENT PRIMARY KEY,"
    . "type TEXT"  //ジャンルを登録
    .");";
    $stmt = $pdo->query($sql);
    
    
    //ユーザーを登録するテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Users" 
    ." ("
    . "userid char(11) PRIMARY KEY,"
    . "username TEXT"  
    .");";
    $stmt = $pdo->query($sql);
    
    
    //作ったテーブルを表示
    $sql = 'SHOW TABLES';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";
    
    
    ?>
    </body>
    
</html>