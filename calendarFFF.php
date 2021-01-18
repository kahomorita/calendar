<?php

$today = new DateTime();



$startDay = new DateTime('first day of this month');

$yearMonth = $startDay -> format('Y-m');

$w = $startDay -> format('w');

$startDay -> modify('-'.$w.'day');


$endDay = new DateTime('last day of this month');

$w = $endDay ->format('w');

$w = 6 - $w + 1;

$endDay -> modify('+'.$w.'day');

$period = new DatePeriod(
  $startDay,
  new DateInterval('P1D'),
  $endDay
);


$body = "";

foreach($period as $day) {
  $grayClass = $day -> format('Y-m')===$yearMonth?'':'grey';

  $todayClass = $day -> format('Y-m-d')===$today->format('Y-m-d')?'today':'';

  if($day -> format('w') == 0) {
    $body.='<tr>';
  }

  $body .=sprintf(
    '<td class="youbi_%d %s %s">%d</td>',
    $day ->format('w'),
    $todayClass,
    $grayClass,
    $day -> format('d')
  );

  if($day -> format('w')==6) {
    $body .='</tr>';
  }
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
        <th><a href="">&laquo;</a></th>
        <th colspan="5"><?php echo $yearMonth ?></th>
        <th><a href="">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>日</td>
        <td>月</td>
        <td>火</td>
        <td>水</td>
        <td>木</td>
        <td>金</td>
        <td>土</td>
      </tr>
      <?php echo $body ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="7"><a href="">today</a></th>
      </tr>
    </tfoot>
  </table>
</body>
</html>