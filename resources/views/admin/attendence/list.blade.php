@extends('layout.index')
@section('title')
    List Offtime
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Off times</li>
                            <li class="breadcrumb-item active">List off time</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <select class="border-info rounded text-blue float-right pl-1"
                            onchange="(location = this.value);">
                            @if (isset($month))
                                <option value="../admin/attendence/list/month={{$month}}">
                                    Month {{$month}}
                                </option>
                            @endif
                            <option value="../admin/attendence/list">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="../admin/attendence/list/month={{$i}}">Month {{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
                @if (session('global'))
                    <div class="alert alert-success global">
                        {{session('global')}}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr class="text-center">
                        <th>STT</th>
                        <th>Fullname</th>
                        <th>Date off</th>
                        <th>Off time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            $full_name = null;
                            $userId = null;
                        ?>
                        @foreach ($attendence as $att)
                            @if ($loop->index > 0  && $full_name != $att->user->full_name)
                                @include ('admin/attendence/subtotal')
                            @endif
                            <tr class="odd gradeX" align="center">
                                <td>{{$i}}</td>
                                @if ($full_name == $att->user->full_name)
                                    <td></td>
                                    <td>{{$att->date}}</td>
                                @else
                                    @php ($full_name = $att->user->full_name)
                                    <td>{{$att->user->full_name}}</td>
                                    <td>{{$att->date}}</td>
                                @endif
                                    @php ($userId = $att->user_id)
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
                                    <td class="center">
                                        <a href="../admin/attendence/edit/{{$att->id}}" >
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="../admin/attendence/delete/{{$att->id}}"
                                           onclick="return confirm('Are you sure you want to delete this attendence?');">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                                @if ($loop->last)
                                    @include ('admin/attendence/subtotal')
                                @endif
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$attendence->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.off-title').addClass('active');
        $('.ot-title, .user-title').removeClass('active');
    </script>
@endsection
