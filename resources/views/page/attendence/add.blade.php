@extends('layout.index')

@section('title')
    Attendence
@endsection

@section('content')
    <!-- START -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Off times</li>
                            <li class="breadcrumb-item active">Add</li>
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
                    <div class="alert text-danger text-bold global">
                        {{session('error')}}
                    </div>
                @endif
                @if (session('global'))
                    <div class="alert alert-success global">
                        {{session('global')}}
                    </div>
                @endif
                <div class="row align-items-stretch no-gutters contact-wrap">
                    <div class="col-md-5">
                        <div class="form">
                            <form action="../page/attendence/add/{{Auth::User()->id}}" method="POST" id="formOff">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-6 col-md-6 form-group mb-3">
                                        <label>User name :</label>
                                        <input name="username" type="text" class="form-control"
                                               value="{{Auth::User()->full_name}}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-6 form-group mb-3">
                                        <label for="dateOff">Date off :</label>
                                        <input type="date" id="dateOff" name="dateOff" class="form-control">
                                    </div>
                                    <div class="col-6 col-md-6 form-group mb-3">
                                        <label for="timeOff">Time off :</label><br>
                                        <select class="form-control" id="timeOff" name="timeOff">
                                            <option value="1">1 (hour)</option>
                                            <option value="4">1/2 (day)</option>
                                            <option value="8">1 (day)</option>
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <label for="reason">Reason off :</label>
                                    <textarea class="work-text" id="reason" name="reason" rows="2"
                                              placeholder="Enter reason off"></textarea>
                                </div><br>
                                <div class="form-group">
                                    <input type="submit" class="form-submit btn btn-info" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr class="text-center">
                                    <th>Date off</th>
                                    <th>Off time</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($list))
                                @foreach ($list as $att)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$att->date}}</td>
                                        <td>
                                            <?php
                                            if ($att->off_time == 8) {
                                                echo '1 (day)';
                                            } elseif ($att->off_time == 4) {
                                                echo '1/2 (day)';
                                            } else {
                                                echo $att->off_time.' (hour)';
                                            }?>
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
                                            }?>
                                        </td>
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
@endsection

@section('script')
    <script src="js/validate-offtime.js"></script>
    <script>
        $('.sidebar__menu--off-time .now-active').addClass('active');
        $('.sidebar__menu--over-time .now-active,' +
            '.sidebar__menu--user .now-active,' +
            '.sidebar__menu--add-ot .now-active').removeClass('active');
    </script>
@endsection
