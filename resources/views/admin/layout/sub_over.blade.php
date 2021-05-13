<td>
    <?php
        $overtime = \App\Overtime::where('user_id', $userId)->get();
        $sub = "00:00:00";
        foreach ($overtime as $over) {
            $ot = $over->over_time;
            list($hour,$minute,$seconds) = explode(':', $ot);
            list($hour1,$minute1,$seconds1) = explode(':', $sub);
            $minute1 += $minute;
            $hour1 += $hour;
            $h = floor($minute1/60);
            $minute1 = $minute1 - $h * 60;
            $hour1 += $h;
            $sub = $hour1.':'.$minute1.':00';
        }
        echo $sub;
    ?>
</td>
