<table>
    <thead>
    <tr>
        <td colspan="6" style="font-weight: bold; font-size: 16px; text-align: center">Attendence</td>
    </tr>
    <tr>
        <th style="font-weight: bold;text-align: center">STT</th>
        <th style="font-weight: bold;text-align: center">Fullname</th>
        <th style="font-weight: bold;text-align: center">Date off</th>
        <th style="font-weight: bold;text-align: center">Off time</th>
        <th style="font-weight: bold;text-align: center">Reason</th>
        <th style="font-weight: bold;text-align: center">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($attendence as $att)
        <tr>
            <td align="center">{{$i}}</td>
            <td>{{$att->user->full_name}}</td>
            <td>{{$att->date}}</td>
            <td>
                <?php
                    if ($att->off_time == 8) {
                        echo '1 (day)';
                    } elseif ($att->off_time == 4) {
                        echo '1/2 (day)';
                    } else {
                        echo $att->off_time.' (hour)';
                    }
                ?>
            </td>
            <td align="left">{{$att->reason}}</td>
            <td align="left">
                <?php
                    if ($att->status == 1) {
                        echo 'Confirmed';
                    } elseif ($att->status == -1) {
                        echo 'Refuse';
                    } else {
                        echo 'Wait for confirmation';
                    }
                ?>
            </td>
        </tr>
    <?php $i++; ?>
    @endforeach
    </tbody>
</table>
