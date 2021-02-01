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

//祝日判定
$holidays = \Yasumi\Yasumi::create('Japan', $year, 'ja_JP');

$body = "";

foreach($period as $day) {
  $grey_class = $day -> format('Y-m')===$year_month?'':'grey';

  $today_class = $day -> format('Y-m-d')===$today->format('Y-m-d')?'today':'';

  $holiday_class = $holidays->isHoliday($day) ? 'holiday' : '';

  if($day -> format('w') == 0) {
    $body.='<tr>';
  }

// sprintf("%s 君は %s を %d 個食べました。", "太郎", "りんご", 7);
// 「太郎 君は りんご を 7個食べました。」
// 「%s」には文字列を、「%d」には数値を代入することができます。
  $body .=sprintf(
    '<td class="youbi_%d %s %s %s">%d<a href="./reserve.php">予約</a></td>',
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
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>カレンダー</title>
</head>
<body>
  <div class="calender_container">
    <div class="calendar_top">
    <a href="?t=<?php echo $prev_month ?>" class="button">&lt;</a>
    <a href="" class="this_year"><?php echo $year_month?></a>
    <a href="?t=<?php echo $next_month ?>" class="button">&gt;</a>
    </div>
    <table class="calendar">
        <tr>
          <th>日</th>
          <th>月</th>
          <th>火</th>
          <th>水</th>
          <th>木</th>
          <th>金</th>
          <th>土</th>
        </tr>
        <?php echo $body ?>
    </table>
  </div>
</body>
</html>