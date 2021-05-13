@extends('layout.index')
@section('title')
    List User overtime
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-5">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Over times</li>
                            <li class="breadcrumb-item active">List over time</li>
                        </ol>
                    </div>
                    <div class="col-sm-5 ml-5">
                        <form action="../admin/overtime/import" method="POST" enctype="multipart/form-data"
                            class="float-right border rounded pl-3 pr-3 form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="row">
                                <input name="import" type="file" id="import">
                                <input type="submit" class="text-success" value="Upload file">
                            </div>
                        </form>
                        @if (count($errors) > 0)
                            <div class="alert text-danger">
                                <div class="float-left">
                                    @foreach ($errors->all() as $err)
                                        {{$err}}<br>
                                    @endforeach
                                </div>
                                <button type="button" class="close float-right btn-sm" data-dismiss="alert">
                                    <i class="fas fa-window-close text-danger"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-1 ml-4">
                        <select class="border-info rounded text-blue float-right p-1"
                            onchange="(location = this.value);">
                            @if (isset($month))
                                <option value="../admin/overtime/list/month={{$month}}">
                                    Month {{$month}}
                                </option>
                            @endif
                            <option value="../admin/overtime/list">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="../admin/overtime/list/month={{$i}}">Month {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    @if (session('global'))
                        <div class="alert alert-success global">
                            {{session('global')}}
                        </div>
                    @endif
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>Stt</th>
                                <th>Username</th>
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
                                <?php
                                    $i = 1;
                                    $full_name = null;
                                    $date = null;
                                    $userId = null;
                                ?>
                                @foreach ($overtime as $ot)
                                    @if ($loop->index > 0  && $full_name != $ot->user->full_name)
                                        @include('admin/over_time/subtotal')
                                    @endif
                                    <tr class="odd gradeX" align="center">
                                        @php ($userId = $ot->user_id)
                                        <td>{{$i}}</td>
                                        @if ($full_name == $ot->user->full_name)
                                            <td></td>
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
                                        @else
                                            @php ($date = $ot->date)
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
                                        @endif
                                        @php ($full_name = $ot->user->full_name)
                                        <td>{{$ot->time_start}}</td>
                                        <td>{{$ot->time_end}}</td>
                                        <td class="text-left">{{$ot->work}}</td>
                                        <td>{{$ot->over_time}}</td>
                                        <td class="center">
                                            <a href="../admin/overtime/edit/{{$ot->id}}" >
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                        <td class="center">
                                            <a href="../admin/overtime/delete/{{$ot->id}}"
                                               onclick="return confirm('Are you sure you want to delete this over time?');">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @if ($loop->last)
                                        @include('admin/over_time/subtotal')
                                    @endif
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    <div>
                        {{$overtime->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.ot-title').addClass('active');
        $('.off-title, .user-title').removeClass('active');
    </script>
@endsection
