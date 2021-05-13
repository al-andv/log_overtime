<tr class="text-bold text-danger">
    <td></td>
    <td colspan="5">TOTAL :</td>
    <td class="text-center">
        <?php
        if (isset($month)) {
            $overtime = \App\Overtime::where('user_id', $userId)->whereMonth('date', $month)->get();
        } else {
            $overtime = \App\Overtime::where('user_id', $userId)->get();
        }
        $sub = "00:00:00";
        foreach ($overtime as $over) {
            $ot = $over->over_time;
            if (isset($ot)) {
                list($hour,$minute,$seconds) = explode(':', $ot);
            }
            list($hour1,$minute1,$seconds1) = explode(':', $sub);
            $minute1 += $minute;
            $hour1 += $hour;
            $h = floor($minute1/60);
            $minute1 = $minute1 - $h * 60;
            $hour1 += $h;
            if (strlen($hour1) == 1) {
                $hour1 = '0'.$hour1;
            }
            if (strlen($minute1) == 1) {
                $minute1 = '0'.$minute1;
            }
            $sub = $hour1.':'.$minute1.':00';
        }
        echo $sub;
        ?>
    </td>
    <td colspan="2"></td>
</tr>
