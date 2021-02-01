<?php

try {
  $db = new PDO('mysql:dbname=reservations;host=127.0.0.1;charset=utf8','root','root');
  $statement = $db -> prepare('INSERT INTO reserve SET name=?,tell=?,email=?,time=?');
  $statement -> bindParam(1,$_POST['name']);
  $statement -> bindParam(2,$_POST['tell']);
  $statement -> bindParam(3,$_POST['email']);
  $statement -> bindParam(4,$_POST['time']);
}catch(PDOException $e) {
  echo 'DB接続エラー:'.$e->getMessage();
}
?>