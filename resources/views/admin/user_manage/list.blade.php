@extends('layout.index')
@section('title')
    List User
@endsection
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item">User manage</li>
                            <li class="breadcrumb-item active">List user</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    @if(session('global'))
                        <div class="alert alert-success global">
                            {{session('global')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th></th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Phone number</th>
                                <th>Picture</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $us)
                                <tr class="odd gradeX" align="center">
                                    <td>
                                        @if($us->status == 1)
                                            <i class="fas fa-circle text-success"></i>
                                        @else
                                            <i class="fas fa-circle"></i>
                                        @endif
                                    </td>
                                    <td class="text-left">{{$us->user_name}}</td>
                                    <td class="text-left">{{$us->full_name}}</td>
                                    <td class="text-left">{{$us->email}}</td>
                                    <td>{{$us->position}}</td>
                                    <td>
                                        <?php
                                            if (isset($us->phone_number)) {
                                                echo "0".$us->phone_number;
                                            } else {
                                                echo "No information";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="user--img">
                                            @if(isset($us->picture))
                                                <img class="img-circle img-size-32 mr-2"
                                                     src="../public/dist/img/{{$us->picture}}" alt="">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="center">
                                        <a href="../admin/user_manage/edit/{{$us->id}}" >
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                    <td class="center">
                                        <a href="../admin/user_manage/delete/{{$us->id}}"
                                           onclick="return confirm('Are you sure you want to ' +
                                               'delete user {{$us->user_name}} ?');">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$user->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.user-title').addClass('active');
        $('.off-title, .ot-title').removeClass('active');
    </script>
@endsection
