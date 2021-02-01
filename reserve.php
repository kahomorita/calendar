<?php
session_start();
$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

  if ($post['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($post['tell'] === '') {
    $error['tell'] = 'blank';
  }
  if ($post['mail'] === '') {
    $error['mail'] = 'blank';
  }else if(!filter_var($post['mail'], FILTER_VALIDATE_EMAIL)){
    $error['mail'] = 'mail';
  }
  if ($post['time'] === '') {
    $error['time'] = 'blank';
  }

  if (count($error) === 0) {
    $_SESSION['form'] = $post;
    header('Location: reserve_confirm.php');
    exit();
}
}else {
  if(isset($_SESSION['form'])) {
    $post =$_SESSION['form'];
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>予約画面</title>
</head>
<body>
  <div class="box_wrap">
    <div class="box">
      <h2 class="reserve_title">ご予約画面</h2>
      <form action="" method="post">
        <div class="confirm_item">
          <p>名前</p><p class="require">必須</p>
        </div>
        <input type="text" name="name" value="<?php echo htmlspecialchars($post['name']); ?>">
        <?php if($error['name']==='blank'):?>
          <p class="error_msg">※名前をご記入ください</p>
        <?php endif; ?>

        <div class="confirm_item">
          <p>電話番号</p><p class="require">必須</p>
        </div>
        <input type="text" name="tell" value="<?php echo htmlspecialchars($post['tell']); ?>">
        <?php if($error['tell']==='blank'):?>
          <p class="error_msg">※名前をご記入ください</p>
        <?php endif; ?>

        <div class="confirm_item">
          <p>メールアドレス</p><p class="require">必須</p>
        </div>
        <input type="email" name="mail" value="<?php echo htmlspecialchars($post['mail']); ?>">
        <?php if($error['mail']==='blank'):?>
          <p class="error_msg">※メールアドレスをご記入ください</p>
        <?php endif; ?>
        <?php if($error['mail']==='mail'):?>
          <p class="error_msg">※メールアドレスを正しくご記入ください</p>
        <?php endif; ?>

        <div class="confirm_item">
          <p>時間</p><p class="require">必須</p>
        </div>
        <select name="time" value="<?php echo htmlspecialchars($post['time']); ?>">
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
          <option value="15:00">15:00</option>
          <option value="15:30">15:30</option>
          <option value="16:00">16:00</option>
          <option value="16:30">16:30</option>
          <option value="17:00">17:00</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
        </select>
          <?php if($error['time']==='blank'):?>
            <p class="error_msg">※時間をご記入ください</p>
          <?php endif; ?>
        <br>
        <button type="submit" class="btn">確認画面へ</button>
      </form>
    </div>
  </div>
</body>
</html>