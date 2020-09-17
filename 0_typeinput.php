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
    
    //ジャンルを登録するテーブル
    $sql = "CREATE TABLE IF NOT EXISTS Types" 
    ." ("
    . "typeid INT AUTO_INCREMENT PRIMARY KEY,"
    . "type TEXT"  //ジャンルを登録
    .");";
    $stmt = $pdo->query($sql);
	
	//DBに書き込み
    //$type = "少年マンガ";   (書き込み済み)
    $sql = $pdo -> prepare("INSERT INTO Types(type) 
    VALUES (:type)");
    $sql -> bindParam(':type', $type, PDO::PARAM_STR);
    $sql -> execute();


    //DBを表示
    $sql = 'SELECT * FROM Types';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //rowの添字[]にはテーブルのカラム名が入る
        echo $row['typeid'].',';
        echo $row['type'].'<br>';
    echo "<hr>";
    }
                //echo"書き込み完了";
                
	
    ?>
    </body>
</html>