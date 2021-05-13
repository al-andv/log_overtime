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
                            <li class="breadcrumb-item">Overtime</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
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
                <div class="row no-gutters contact-wrap">
                    <div class="col-md-5">
                        <div class="form">
                            <form action="../page/overtime/edit/{{$overtime->id}}" method="POST" id="formOT">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input name="username" value="{{$overtime->user_id}}" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="dateOT">Date OT :</label>
                                        <input type="date" id="dateOT" name="dateOT" class="form-control"
                                               value="{{$overtime->date}}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="dateOT">Date type :</label>
                                        <select class="form-control" name="date_type">
                                            <option value="{{$overtime->date_type}}">
                                                <?php
                                                if ($overtime->date_type == 1) {
                                                    echo "Weekday";
                                                } elseif ($overtime->date_type == 2) {
                                                    echo "Weekend";
                                                } else {
                                                    echo "Holiday";
                                                }
                                                ?>
                                            </option>
                                            <option value="1">Weekday</option>
                                            <option value="2">Weekend</option>
                                            <option value="3">Holiday</option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="start">Time start :</label>
                                        <input type="time" name="start" id="start" class="form-control"
                                               value="{{$overtime->time_start}}">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="end">Time end :</label>
                                        <input type="time" id="end" name="end" class="form-control"
                                               value="{{$overtime->time_end}}">
                                        <span class="error-time small"></span>
                                    </div>
                                </div><br>
                                <div class="row form-group">
                                    <label for="work">Work OT:</label>
                                    <textarea class="work-text" id="work" name="work" rows="3"
                                              placeholder="Enter work OT">{{$overtime->work}}</textarea>
                                </div><br>
                                <div class="form-group">
                                    <input type="submit" class="form-submit btn btn-info" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="container-fluid">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>Work</th>
                                        <th>Overtime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($list))
                                    @foreach($list as $ot)
                                        <tr class="odd gradeX" align="center">
                                            <td>{{$ot->date}}</td>
                                            <td>{{$ot->time_start}}</td>
                                            <td>{{$ot->time_end}}</td>
                                            <td class="text-left">{{$ot->work}}</td>
                                            <td>{{$ot->over_time}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="js/validate-overtime.js"></script>
    <script>
        $('.sidebar__menu--over-time .now-active').addClass('active');
        $('.sidebar__menu--off-time .now-active,' +
            '.sidebar__menu--user .now-active,' +
            '.sidebar__menu--add-ot .now-active').removeClass('active');
    </script>
@endsection
