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
  $grayClass = $day -> format('Y-m')===$yearMonth?'':'gray';

  $todayClass = $day -> format('Y-m-d')===$today->format('Y-m-d')?'today':'';

  if($day -> format(W) == 0) {
    $body.='<tr>';
  }
}


?>