<table>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: bold">List user</td>
    </tr>
    <thead>
        <tr>
            <th style="text-align: center;font-weight: bold">Stt</th>
            <th style="text-align: center;font-weight: bold">Username</th>
            <th style="text-align: center;font-weight: bold">Fullname</th>
            <th style="text-align: center;font-weight: bold">Email</th>
            <th style="text-align: center;font-weight: bold">Position</th>
            <th style="text-align: center;font-weight: bold">Phone number</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    @foreach($user as $us)
        <tr>
            <td align="center">{{$i}}</td>
            <td>{{$us->user_name}}</td>
            <td>{{$us->full_name}}</td>
            <td>{{$us->email}}</td>
            <td>{{$us->position}}</td>
            <td align="right">
                <?php
                if (isset($us->phone_number)) {
                    echo "0".$us->phone_number;
                } else {
                    echo "";
                }
                ?>
            </td>
        </tr>
        <?php $i++; ?>
    @endforeach
    </tbody>
</table>
