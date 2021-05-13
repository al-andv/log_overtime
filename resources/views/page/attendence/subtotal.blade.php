<tr class="text-success text-bold text-danger">
    <td  colspan="2" class="text-center">TOTAL:</td>
    <td class="" colspan="2">
        <?php
            if (isset($month)) {
                $attendence = \App\Attendence::where('user_id', $userId)->whereMonth('date',$month)->get();
            } else {
                $attendence = \App\Attendence::where('user_id', $userId)->get();
            }
            $sub = 0;
            foreach ($attendence as $att) {
                if ($att->status == 1) {
                    $off = $att->off_time;
                    $sub += $off;
                }
            }
            $day = floor($sub/8);
            $hour = ($sub - ($day * 8));
            echo $day.' (days) - '.$hour.' (hours)';
        ?>
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="5"></td>
</tr>
