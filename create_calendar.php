
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<?php

//create_calendar( int:表示させるカレンダーの数, str:初めの年月 )
function create_calendar( $num = 1, $set = false ) {

  //今日
    $date = new DateTime();
    $today = $date->format( 'Y-n-j' );

  //最初の月
    if( $set ) {
        $date = new DateTime( $set );
    }

    for( $i = 0; $i < $num; ++$i ) {

      //描画する月
        $month = $date->format( 'Y-n' );

      //1ヶ月すすめる
      //modify()...日時の加算、減算をする。
        $date->modify( '+1 months' );

      //年-月の分離
        list( $y, $m ) = explode( '-', $month );

      //月の初めの曜日
        $start_date = new DateTime( 'first day of ' .$month );
        $week = $start_date->format( 'w' );

      //月の終わりの日
        $end_date  = new DateTime( 'last day of ' .$month );
        $end = $end_date->format( 'j' );

      //カレンダーテーブル
        echo '<table>';
        echo '<thead>
                <tr>
                    <th colspan="7" class="month">
                    '.$y.'年'.$m.'月</th>
                </tr>
            </thead>';
        echo '<tbody>';
        echo '<tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>';

      //週の数
        $week_line = 0;

        for( $day = 1; $day <= $end; ++$day ) {

          //1日、もしくは日曜日
            if( $day == 1 || $week == 0 ) {
                echo '<tr>';
                ++$week_line;
            }

          //1日かつ日曜日ではない
            if( $day == 1 && $week != 0 ) {
                for( $c = 0; $c < $week; ++$c ) {
                    echo '<td class="blank"></td>';
                }
            }

          //日
          //今日は<strong></strong>で太くして強調している。
            if ( $month.'-'.$day == $today ) {
                echo '<td><strong>'.$day.'</strong></td>';
            } else {
                echo '<td>'.$day.'</td>';
            }

          //最終日かつ土曜日ではない
            if( $day == $end && $week != 6 ) {
                for( $c = $week; $c < 6; ++$c ) {
                    echo '<td class="blank"></td>';
                }
            }

          //最終日、もしくは土曜日
            if( $day == $end || $week == 6 ) {
                echo '</tr>';
            }

            //曜日をすすめる
            if( $week == 6 ) {
                $week = 0;
            } else {
                ++$week;
            }

        }

      //表示するカレンダーが複数かつ週の数が6未満の場合
        if( $num != 1 && $week_line < 6 ) {
            for( $n = $week_line; $n < 6; ++$n ) {
                echo '<tr>';
                for( $c = 0; $c < 7; ++$c ) {
                    echo '<td class="blank">&ensp;</td>';
                }
                echo '</tr>';
            }
        }

        echo '</tbody>';
        echo '</table>';

    }

}
    create_calendar(1,'2021-1');

?>

</body>
</html>

