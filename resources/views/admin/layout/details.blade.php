@extends('layout.index')

@section('title')
    Search details
@endsection

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Details</li>
                            <li class="breadcrumb-item active">"{{$data['user']->full_name}}"</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    @if(session('global'))
                        <div class="alert alert-danger">
                            {{session('global')}}
                        </div>
                    @endif
                    <div class="breadcrumb-item"> Over time</div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr class="text-center">
                            <th>Stt</th>
                            <th>User name</th>
                            <th>Date</th>
                            <th>Date_type</th>
                            <th>Over time</th>
                            <th>Work</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data['ot'] as $ot)
                            <tr class="odd gradeX" align="center">
                                <td>{{$i}}</td>
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
                                <td>{{$ot->over_time}}</td>
                                <td class="text-left">{{$ot->work}}</td>
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
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="breadcrumb-item"> Off time</div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>User name</th>
                            <th>Date off</th>
                            <th>Time off</th>
                            <th>Reason off</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['off'] as $off)
                            <tr class="odd gradeX" align="center">
                                <td>{{$off->id}}</td>
                                <td>{{$off->user->full_name}}</td>
                                <td>{{$off->date}}</td>
                                <td>{{$off->off_time}}</td>
                                <td class="text-left">{{$off->reason}}</td>
                                <td class="center">
                                    <a href="../admin/attendence/edit/{{$off->id}}" >
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td class="center">
                                    <a href="../admin/attendence/delete/{{$off->id}}"
                                       onclick="return confirm('Are you sure you want to delete this attendence?');">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
