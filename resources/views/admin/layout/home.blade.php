@extends('layout.index')

@section('title')
    Home
@endsection

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                    <div class="pagination-sm float-right">
                        {{$users->links()}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- OT List -->
                        <div class="card list-ot">
                            <div class="card-header border-0">
                                <h3 class="card-title">Over time</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Username</th>
                                        <th>Overtime</th>
                                        <th>More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $userId = null; ?>
                                        @foreach ($users as $us)
                                            <tr>
                                                <td class="user--img">
                                                    @if(isset($us->picture))
                                                        <img src="dist/img/{{$us->picture}}" class="img-circle
                                                            img-size-32 mr-2">
                                                    @else
                                                        <img src="dist/img/default-150x150.png" class="img-circle
                                                            img-size-32 mr-2">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($us->full_name))
                                                        {{$us->full_name}}
                                                    @else
                                                        {{$us->user_name}}
                                                    @endif
                                                </td>
                                                </td>
                                                @php ($userId = $us->id)
                                                @include ('admin/layout/sub_over')
                                                <td class="text-center">
                                                    <a href="../admin/home/export-ot/{{$us->id}}"
                                                       onclick="return confirm('Are you sure you want to export ' +
                                                            'over time user?');">
                                                        <i class="fas fa-file-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- attendence -->
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="ion fa-times-circle mr-1"></i>
                                    Attendence
                                </h3>
                            </div>
                            <hr class="mt-3">
                            <div class="container-fluid">
                                @foreach ($users as $us)
                                    <div class="d-flex justify-content-between align-items-center mb-3 atten-body">
                                        <p class="text-success p-left">
                                            @if(isset($us->full_name))
                                                {{$us->full_name}}
                                            @else
                                                {{$us->user_name}}
                                            @endif
                                        </p>
                                        @php ($userId = $us->id)
                                        <p class="d-flex flex-column">
                                            @include ('admin/layout/sub_off')
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <!-- TO DO List -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-clipboard mr-1"></i>
                                    To Do List
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <ul class="todo-list" data-widget="todo-list">
                                    @foreach($lists as $list)
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                              <i class="fas fa-ellipsis-v"></i>
                                              <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <!-- todo text -->
                                            <span class="text">{{$list->work_to_do}}</span>
                                            <!-- Emphasis label -->
                                            <small class="badge badge-primary">
                                                <i class="far fa-calendar"></i> {{$list->time}}
                                            </small>
                                            <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <a href="../admin/home/list-to-do/delete/{{$list->id}}"
                                                    onclick="return confirm('Are you sure you want to delete ' +
                                                        'work to do ?');">
                                                    <i class="fas fa-trash-alt text-danger"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            <form action="../admin/home/list-to-do/add" method="POST" id="listForm"
                                class="row card-footer clearfix">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-md-6 form-group">
                                    <input class="form-control" type="text" id="todo" name="todo"
                                        placeholder="To do ...">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="form-control" id="date_todo" name="date_todo" type="date">
                                </div>
                                <div class="col-md-2 form-group">
                                    <input class="btn btn-primary" type="submit" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Calendar -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Calendar
                                </h3>
                                <div class="card-tools">
                                    <ul class="pagination-sm">
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <iframe  src="https://calendar.google.com/calendar/embed?src=vi.vietnamese%23holiday%40group.v.calendar.google.com&ctz=Asia%2FHo_Chi_Minh"
                                    width="100%" height="333px" frameborder="0" scrolling="no" class="calendar">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="js/validate-home.js"></script>
@endsection
