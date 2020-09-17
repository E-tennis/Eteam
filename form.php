<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <?php
    require_once 'function.php';

    $pdo = connectDB();

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得
        $sql = 'SELECT * FROM images ORDER BY created_at DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll();
    } else {
    // 画像を保存
        if (!empty($_FILES['image']['name'])) {
            $name = $_FILES['image']['name'];
            $type = $_FILES['image']['type'];
            $content = file_get_contents($_FILES['image']['tmp_name']);
            $size = $_FILES['image']['size'];

            $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, now())';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
            $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
            $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
            $stmt->execute();
        }
        unset($pdo);
        header('Location:form.php');
        exit();
    }

    unset($pdo);
    ?>
    <ul>
    <?php for($i = 0; $i < count($images); $i++): ?>
        <li>
            <a data-toggle="modal" data-slide-to="<?= $i; ?>">
                <img src="image_output.php?id=<?= $images[$i]['image_id']; ?>"  width="100px" height="auto">
            </a>
            <h5><?= $images[$i]['image_name']; ?> (<?= number_format($images[$i]['image_size']/1000, 2); ?> KB)</h5>
        </li>
    <?php endfor; ?>
    </ul>
    <form method="post" enctype="multipart/form-data">
        <label>画像を選択</label>
        <input type="file" name="image" required>
        <button type="submit">送信</button>
    </form>
</html>