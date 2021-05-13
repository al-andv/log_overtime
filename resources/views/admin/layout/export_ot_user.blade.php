<table>
    <tr>
        <td colspan="8" style="font-weight: bold; font-size: 16px; text-align: center">Over time</td>
    </tr>
    <thead>
        <tr>
            <th style="text-align: center;font-weight: bold">STT</th>
            <th style="text-align: center;font-weight: bold">Username</th>
            <th style="text-align: center;font-weight: bold">Email</th>
            <th style="text-align: center;font-weight: bold">Date OT</th>
            <th style="text-align: center;font-weight: bold">Time start</th>
            <th style="text-align: center;font-weight: bold">Time end</th>
            <th style="text-align: center;font-weight: bold">Work OT</th>
            <th style="text-align: center;font-weight: bold">Over time</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($overtime as $ot)
        <tr>
            <td align="center">{{$i}}</td>
            <td>{{$ot->user->full_name}}</td>
            <td>{{$ot->user->email}}</td>
            <td>{{$ot->date}}</td>
            <td align="right">{{$ot->time_start}}</td>
            <td align="right">{{$ot->time_end}}</td>
            <td align="left">{{$ot->work}}</td>
            <td align="right">{{$ot->over_time}}</td>
        </tr>
    <?php $i++; ?>
    @endforeach
    </tbody>
</table>
