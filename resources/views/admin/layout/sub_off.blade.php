<?php
    $attendence = \App\Attendence::where('user_id', $userId)->get();
    $sub = 0;
    foreach ($attendence as $att) {
        if ($att->status == 1) {
            $off = $att->off_time;
            $sub += $off;
        }
    }
    echo $sub.' (hours)';
?>
