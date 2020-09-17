<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title></title>
    </head>
    <?php
    // データベースに接続
    function connectDB() {
        $param = 'mysql:dbname=tb220203db;host=localhost';
        try {
            $pdo = new PDO($param, 'tb-220203', "ZUeNJmKnJJ");
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
?>
</html>