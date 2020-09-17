<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
    <?php
        //DB下準備
        $dsn = 'mysql:dbname=tb220203db;host=localhost';
        $user = 'tb-220203';
        $password = "ZUeNJmKnJJ";
        $pdo = new PDO($dsn, $user, $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        
        $sql = "CREATE TABLE IF NOT EXISTS images"  //もしテーブルがなかったら作成
        . "image_id INT AUTO_INCREMENT PRIMARY KEY,"
        . "image_name varchar(256)"
        . "image_type varchar(64)"
        . "image_content mediumblob"
        . "image_size int"
        . "created_at datetime";
        $stmt = $pdo->query($sql);
    ?>
    
    </body>
</html>