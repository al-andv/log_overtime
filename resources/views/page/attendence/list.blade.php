@extends('layout.index')
@section('title')
    Attendence
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Off times</li>
                            <li class="breadcrumb-item active">"{{Auth::User()->full_name}}"</li>
                        </ol>
                    </div>
                    <a href="../page/attendence/add/{{Auth::User()->id}}"
                       class="border border-success text-success float-right rounded pt-1 pl-1 pr-1">
                        <i class="fas fa-plus"></i> Add
                    </a>
                    <div class="col-sm-1">
                        <select class="border-info rounded text-blue p-2"
                                onchange="(location = this.value);">
                            @if (isset($month))
                                <option value="../page/attendence/{{Auth::User()->id}}/month={{$month}}">
                                    Month {{$month}}
                                </option>
                            @endif
                            <option value="../page/attendence/{{Auth::User()->id}}">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="../page/attendence/{{Auth::User()->id}}/month={{$i}}">Month {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                @if (session('global'))
                    <div class="alert alert-success global">
                        {{session('global')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Date off</th>
                        <th>Off time</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($attendence))
                        <?php
                            $i = 1;
                            $userId = null;
                            if (!isset($id)) {
                                $id = null;
                            }
                        ?>
                        @foreach ($attendence as $att)
                            @if($id == $att->id)
                                <tr class="odd gradeX badge-warning" align="center">
                                @else
                                    <tr class="odd gradeX" align="center">
                                @endif
                                    @php ($userId = $att->user_id)
                                    <td>{{$i}}</td>
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
                                    <td class="text-left">{{$att->reason}}</td>
                                    <td class="text-left">
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
                            @if ($loop->last)
                                @include ('page/attendence/subtotal')
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <div>{{$attendence->links()}}</div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.sidebar__menu--off-time .now-active').addClass('active');
        $('.sidebar__menu--over-time .now-active,' +
            ' .sidebar__menu--user .now-active,' +
            ' .sidebar__menu--add-ot .not-active').removeClass('active');
    </script>
@endsection
