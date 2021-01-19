<?php

require 'vendor/autoload.php';

$today = new DateTime();

if(isset($_GET['t']) && preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
  //クエリ情報を基にしてDateTimeインスタンスを作成
  $start_day = new DateTime($_GET['t'] . '-01');
} else {
  //当月初日のDateTimeインスタンスを作成
  $start_day = new DateTime('first day of this month');
}

//カレンダーの前月の年月を取得
$dt = clone($start_day);
$prev_month =  $dt->modify('-1 month')->format('Y-m');

//翌月の年月を取得
$dt = clone($start_day);
$next_month = $dt -> modify('+1 month') -> format('Y-m');


$year_month = $start_day -> format('Y-m');

$year = $start_day->format('Y');

$w = $start_day -> format('w');

$start_day -> modify('-'.$w.'day');


$end_day = new DateTime('last day of'.$year_month);

$w = $end_day ->format('w');

$w = 6 - $w + 1;

$end_day -> modify('+'.$w.'day');

$period = new DatePeriod(
  $start_day,
  new DateInterval('P1D'),
  $end_day
);

$holidays = \Yasumi\Yasumi::create('Japan', $year, 'ja_JP');

$body = "";

foreach($period as $day) {
  $grey_class = $day -> format('Y-m')===$year_month?'':'grey';

  $today_class = $day -> format('Y-m-d')===$today->format('Y-m-d')?'today':'';

  $holiday_class = $holidays->isHoliday($day) ? 'holiday' : '';

  if($day -> format('w') == 0) {
    $body.='<tr>';
  }

  $body .=sprintf(
    '<td class="youbi_%d %s %s %s">%d</td>',
    $day ->format('w'),
    $today_class,
    $grey_class,
    $holiday_class,
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
        <th><a href="?t=<?php echo $prev_month ?>">&laquo;</a></th>
        <th colspan="5"><a href=""><?php echo $year_month ?></a></th>
        <th><a href="?t=<?php echo $next_month ?>">&raquo;</a></th>
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