<?php

session_start();

$post = $_SESSION['form'];

try {
  $db = new PDO('mysql:dbname=reservations;host=localhost:8889;charset=utf8','root','root');
  $statement = $db->prepare('INSERT INTO reserve (name,tell,mail,time) values(:name,:tell,:mail,:time)');
  $statement -> bindParam(':name',$post['name'],PDO::PARAM_STR);
  $statement -> bindParam(':tell',$post['tell'],PDO::PARAM_STR);
  $statement -> bindParam(':mail',$post['mail'],PDO::PARAM_STR);
  $statement -> bindParam(':time',$post['time'],PDO::PARAM_STR);
  $statement -> execute();
}catch(PDOException $e) {
  echo 'DB接続エラー:'.$e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>ご予約完了</title>
</head>
<body>
  <div class="box">
      <p class="complete_msg">以下の内容でご予約が完了しました。</p>
      <div class="message_info">
        <p>名前:</p><?php echo htmlspecialchars($post['name']); ?>
      </div>
      <div class="message_info">
        <p>電話番号:</p><?php echo htmlspecialchars($post['tell']); ?>
      </div>
      <div class="message_info">
        <p>メールアドレス:</p><?php echo htmlspecialchars($post['mail']); ?>
      </div>
      <div class="message_info">
        <p>時間:</p><?php echo htmlspecialchars($post['time']); ?>
      </div>

      <a href="index.php" class="btn">topへ戻る</a>
  </div>

  <?php
  unset($_SESSION['form']);
  ?>
</body>
</html>