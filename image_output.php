<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='UTF-8'>
        <title></title>
    </head>
    <?php
    require_once 'function.php';
    $pdo = connectDB();
    //データベース接続

    $sql = 'SELECT * FROM images WHERE image_id = :image_id LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch();
    
    header('Content-type:' . $image['image_type']);
    echo $image['image_content'];
    //画像を出力

    unset($pdo);
    exit();
?>
</html>