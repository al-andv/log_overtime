@extends('layout.index')
@section('title')
    Overtime
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Over times</li>
                            <li class="breadcrumb-item active">"{{Auth::User()->full_name}}"</li>
                        </ol>
                    </div>
                    <div class="col-sm-6 text-right">
                        <select class="border-info rounded text-blue pl-1"
                            onchange="(location = this.value);">
                            @if( isset($month))
                                <option value="../page/overtime/{{Auth::User()->id}}/month={{$month}}">
                                    Month {{$month}}
                                </option>
                            @endif
                            <option value="../page/overtime/{{Auth::User()->id}}">All</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="../page/overtime/{{Auth::User()->id}}/month={{$i}}">Month {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    @if(session('error'))
                        <div class="alert alert-danger global">
                            {{session('error')}}
                        </div>
                    @endif
                    @if(session('global'))
                        <div class="alert alert-success global">
                            {{session('global')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Date</th>
                                <th>Type date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Work</th>
                                <th>Overtime</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($overtime))
                            <?php
                                $i = 1;
                                $date = null;
                            ?>
                            @foreach($overtime as $ot)
                                @if ($loop->index > 0  && $date != $ot->date)
                                    @include ('page/over_time/subtotal')
                                @endif
                                <tr class="odd gradeX" align="center">
                                    @php ($userId = $ot->user_id)
                                    <td>{{$i}}</td>
                                    @if ($date == $ot->date)
                                        <td colspan="2"></td>
                                    @else
                                        @php ($date = $ot->date)
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
                                    @endif
                                    <td>{{$ot->time_start}}</td>
                                    <td>{{$ot->time_end}}</td>
                                    <td class="text-left">{{$ot->work}}</td>
                                    <td>{{$ot->over_time}}</td>
                                    <td class="center">
                                        <a href="../page/overtime/edit/{{$ot->id}}" >
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="../page/overtime/delete/{{$ot->id}}"
                                            onclick="return confirm('Are you sure you want to delete this overtime ?');">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                @if ($loop->last)
                                    @include ('page/over_time/subtotal')
                                    @include ('page/over_time/total')
                                @endif
                                <?php $i++; ?>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div>{{$overtime->links()}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.sidebar__menu--over-time .now-active').addClass('active');
        $('.sidebar__menu--off-time .now-active,' +
            '.sidebar__menu--user .now-active,' +
            '.sidebar__menu--add-ot .now-active').removeClass('active');
    </script>
@endsection
