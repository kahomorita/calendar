<?php

$body = '';

$period = new DatePeriod(
  new DateTime('first day of this month'),

  // P１D...1日毎のデータを取得する
  // P7D...7日毎のデータを取得する
  new DateInterval(P1D),
  new DateTime('first day of next month')
);

// sprintf("%s 君は %s を %d 個食べました。", "太郎", "りんご", 7);
// 「太郎 君は りんご を 7個食べました。」
// 「%s」には文字列を、「%d」には数値を代入することができます。
// 結合代入演算子('.=')で、 この演算子は右側の引数に左側の引数を追加します。
foreach($period as $day) {
  if($day->format('w')%7===0) {$body .= '</tr><tr>';}
  $body .= sprintf('<td>%d</td>',$day->format('d'));
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>カレンダー</title>
</head>
<body>
  <table>
    <thead>
      <tr>
        <th><a href="#">&laquo;</a></th>
        <th colspan="5">January 2021</th>
        <th><a href="#">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sun</td>
        <td>Mon</td>
        <td>Tue</td>
        <td>Web</td>
        <td>Thu</td>
        <td>Fri</td>
        <td>Sat</td>
      </tr>
      <tr>
        <?php echo $body; ?>
      </tr>
    </tbody>
    <tfoot>
      <th colspan="7"><a href="#">Today</a></th>
    </tfoot>
  </table>
</body>
</html>