<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title>SQL試作品</title>
    </head>
    
    <body>
    <?php
    $dsn = 'mysql:---;host=localhost';
    $user = '---';
    $password = '---';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
	
	//本を登録するテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Books" 
    ." ("
    . "bookid INT AUTO_INCREMENT PRIMARY KEY,"
    . "bookname TEXT,"
    . "type int,"  //ジャンル（Typesテーブルのtypeidを登録→後に結合）
    . "image mediumblob"  //画像を登録
    .");";
    $stmt = $pdo->query($sql);
	
	
	//DB書き込み内容ーー書き込み済み
	$bookname = "ワンピース";
    $type = "1";
    $image = "https://images-na.ssl-images-amazon.com/images/I/61QPqVDUzVL._SX315_BO1,204,203,200_.jpg"; //仮で入れてみました（画像表示されなかったです、、）


    //DBに書き込み
    $sql = $pdo -> prepare("INSERT INTO Books(bookname, type, image) 
    VALUES (:bookname, :type, :image)");
    $sql -> bindParam(':bookname', $bookname, PDO::PARAM_STR);
    $sql -> bindParam(':type', $type, PDO::PARAM_STR);
    $sql -> bindParam(':image', $image, PDO::PARAM_STR);
    $sql -> execute();

    
    //DBを表示
    $sql = 'SELECT * FROM Books';
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
                //echo"書き込み完了";
                
	
    ?>
    </body>
</html>