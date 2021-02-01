<?php

session_start();

$post = $_SESSION['form'];

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>予約確認画面</title>
</head>
<body>
<div class="box">
    <h1 class="message_confirm">ご予約内容</h1>
    <form action="reserve_complete.php" method="post">
      <div class="message_info">
        <p class="reserve_item">名前:</p><?php echo htmlspecialchars($post['name']); ?>
      </div>
      <div class="message_info">
        <p class="reserve_item">電話番号:</p><?php echo htmlspecialchars($post['tell']); ?>
      </div>
      <div class="message_info">
        <p class="reserve_item">メールアドレス:</p><?php echo htmlspecialchars($post['mail']); ?>
      </div>
      <div class="message_info">
        <p class="reserve_item">時間:</p><?php echo htmlspecialchars($post['time']); ?>
      </div>

      <p class="last_confirm">こちらの内容でよろしいですか？</p>

      <div class="confirm_area">
        <a href="./reserve.php" class="btn">いいえ</a>
        <button type="submit" class="btn">はい</button>
      </div>
    </form>
  </div>
</body>
</html>