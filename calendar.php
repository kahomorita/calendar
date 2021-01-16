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
  $body .= sprintf('<td>%d</td>',$day->format('d'));
}

?>