<!DOCTYPE html>
<html lang = ja>

<head>
  
  <meta charset = "UFT-8">
  <title>
    mypage
  </title>
  <link rel= "stylesheet" herf="stylesheet.css">
  
</head>


<body>
  
  <form action = "" method = "post" enctype = "multipart/form-date">
   
    <p>
    //画像の表示はされない
    作品アイコン<input type = "file" name = "pic"><br>    
    作品名<input type = "text" name = "bookname" placeholder = "作品名"><br>
    ジャンル<input type = "radio" name = "type" value = "バトル" ><input type = "radio" name = "type" value = "ミステリー"><br>
    評価<input type = "number" name = "review" min = "1" max = "5" ><br>
    コメント<input type = "text" name = "comment" placeholder = "コメント"><br>
    読み終えた日<input type = "date" name = "readdate">
    
    <input type = "submit" name = "submit">
   </p>
     
  </form>
 <?php
  /*-------------変数----------------*/
  $bookname = $_POST["bookname"];
  $review   = $_POST["review"];
  $comment  = $_POST["comment"];
  $readdate = $_POST["readdate"];
  $type     = $_POST["type"];
  
  //DBへの接続設定
  $dsn = 'mysql:ーーーb;host=localhost';
  $user = 'ーーー';
  $password = 'ーーー';
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    
  /*----------------------------------テーブルの作成-----------------------------------------------------------*/
  
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
    
  
  /*-------------------------------------DBへの入力---------------------------------------*/
  
  	//DB書き込み内容ーー書き込み済み
    
    //$image = "https://images-na.ssl-images-amazon.com/images/I/61QPqVDUzVL._SX315_BO1,204,203,200_.jpg"; //仮で入れてみました（画像表示されなかったです、、）


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
  
/*写真ファイルをサーバーにアップロードする。
  if(strlen($_FILES["pic"]["name"])>0)
  {
      $filename = $_FILES["pic"]["name"]
      if(! move_uploaded_file($_FILES["pic"]["tmp_name"],$filename) )
      {
          echo "アップロードに失敗しました。<br>";
      }else{
          echo "name=";
          echo $filename;
          echo "<br>";
          echo "<IMG src='$filename'>";
          echo "<br>";
      }
    }else{
          echo "ファイルをアップロードしてください";
    }
  
  */
  ?>
</body>

</html>
