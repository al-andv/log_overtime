@extends('layout.index')

@section('title')
    Overtime
@endsection

@section('content')
    <!-- START -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Over times</li>
                            <li class="breadcrumb-item active">Log Overtime</li>
                        </ol>
                    </div>
                </div>
                <hr class="divider my-4">
                <div class="row">
                    <div class="col-md-5">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if (isset($error))
                            <div class="alert text-danger text-bold global">
                                {{$error}}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert text-bold text-danger global">
                                {{session('error')}}
                            </div>
                        @endif
                        @if (session('global'))
                            <div class="alert alert-success global">
                                {{session('global')}}
                            </div>
                        @endif
                        <form action="../page/overtime/add/{{Auth::User()->id}}" method="POST"
                              class="container-fluid badge-light">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input name="overtimeId" type="hidden" value="<?php
                                if (isset($overtime['id'])) { echo $overtime['id'];} ?>">
                            <label for="dateOT" class="col-4 col-md-4">Date OT:</label>
                            <input class="text-center" id="dateOT" name="dateOT" value="<?php
                                if (isset($overtime['date'])) {
                                    echo $overtime['date'];
                                } else {
                                    $date = getdate();
                                    $month = $date['mon'];
                                    $day = $date['mday'];
                                    if (strlen($month) == 1) {
                                        $month = '0'.$month;
                                    }
                                    if (strlen($day) == 1) {
                                        $day = '0'.$day;
                                    }
                                    echo $date['year']."-".$month."-".$day;
                                }?>" readonly size="8"><br>
                                <label for="date_type" class="col-4 col-md-4">Date-type:</label>
                            <select class="text-center date_type" name="date_type" id="date_type">
                                <?php if (isset($overtime['data_type'])) {?>
                                <option value="{{$overtime['date_type']}}">
                                    <?php
                                    if ($overtime['date_type'] == 1) {
                                        echo "Weekday";
                                    } elseif ($overtime['date_type'] == 2) {
                                        echo "Weekend";
                                    } else {
                                        echo "Holiday";
                                    }
                                echo '</option>'; }?>
                                <option value="1">Weekday</option>
                                <option value="2">Weekend</option>
                                <option value="3">Holiday</option>
                            </select><br>
                            <div class="form-group">
                                <label class="form-control" for="start">Start over time:</label>
                                <div class="row">
                                    <div class="col-4 col-md-4 text-center">
                                        <input type="submit" class="btn btn-success" id="start_ot"
                                            name="action" value="Start">
                                    </div>
                                    <div class="col-8 col-md-8">
                                        <input type="time" id="start" name="start" class="start-ot text-center"
                                            value="<?php if (isset($overtime['start'])) {
                                                echo $overtime['start'];
                                            }?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control" for="end">End over time:</label>
                                <div class="row">
                                    <div class="col-4 col-md-4 text-center">
                                        <input type="submit" class="btn btn-danger" id="end_ot" name="action"
                                               value="End">
                                    </div>
                                    <div class="col-8 col-md-8">
                                        <input type="time" id="end" name="end" class="end-ot text-center"
                                            value="<?php if (isset($overtime['end'])) {
                                                echo $overtime['end'];
                                            } ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control" for="work">Work to Over time</label>
                                <textarea class="col-md-12" id="work" name="work"
                                    placeholder="Enter work"><?php
                                    if (isset($overtime['work'])) {
                                        echo $overtime['work'];
                                    }
                                    ?></textarea>
                            </div>
                            <input type="submit" value="Save Entry" class="btn btn-info" name="action">
                        </form><br>
                    </div>
                    <div class="col-md-7">
                        <iframe src="https://calendar.google.com/calendar/embed?src=vi.vietnamese%23holiday%40group.v.calendar.google.com&ctz=Asia%2FHo_Chi_Minh"
                            width="100%" height="490px" frameborder="0" scrolling="no"
                            class="calendar"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END -->
@endsection

@section('script')
    <script src="js/validate-overtime.js"></script>
    <script>
        $('.sidebar__menu--add-ot .now-active').addClass('active');
        $('.sidebar__menu--off-time .now-active,' +
            '.sidebar__menu--over-time .now-active,' +
            '.sidebar__menu--user .now-active').removeClass('active');
    </script>
@endsection
