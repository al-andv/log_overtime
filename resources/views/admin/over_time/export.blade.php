<table>
    <thead>
    <tr>
        <td colspan="8" style="font-weight: bold; text-align: center; font-size: 16px;">
            List over time
        </td>
    </tr>
    <tr>
        <th style="text-align: center;font-weight: bold">Stt</th>
        <th style="text-align: center;font-weight: bold">Username</th>
        <th style="text-align: center;font-weight: bold">Date</th>
        <th style="text-align: center;font-weight: bold">Date type</th>
        <th style="text-align: center;font-weight: bold">Start time</th>
        <th style="text-align: center;font-weight: bold">End time</th>
        <th style="text-align: center;font-weight: bold">Work</th>
        <th style="text-align: center;font-weight: bold">Overtime</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($overtime as $ot)
        <tr>
            <td align="center">{{$i}}</td>
            <td>{{$ot->user->full_name}}</td>
            <td>{{$ot->date}}</td>
            <td>
                <?php
                if ($ot->date_type == 1) {
                    echo "weekday";
                } elseif ($ot->date_type == 2) {
                    echo "weekend";
                } else {
                    echo "holiday";
                }
                ?>
            </td>
            <td align="right">{{$ot->time_start}}</td>
            <td align="right">{{$ot->time_end}}</td>
            <td align="left">{{$ot->work}}</td>
            <td align="right">{{$ot->over_time}}</td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
