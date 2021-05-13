<?php
    $id = Auth::user()->id;
    $getNoti = \App\Notification::where('user_id_to', $id)->orderBy('created_at', 'DESC')->get();
    $count = $getNoti->where('status', 0)->count();
    if (Auth::User()->role == 0){
?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-cyan navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle-btn" id="push-menu" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../page/home" class="nav-link text-bold">
                    <i class="fas fa-home"></i>Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../page/contact" class="nav-link  text-bold">
                    <i class="fas fa-phone-alt"></i> Contact</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if($count > 0)
                        <span class="badge badge-warning navbar-badge">{{$count}}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"><?php
                        echo $count; ?> New Notifications</span>
                    <div class="dropdown-divider"></div>
                    @foreach ($getNoti as $noti)
                        @if($noti->status == 1)
                            <a href="../page/notification/{{$noti->id}}" class="dropdown-item text-muted">
                                <i class="fas fa-clock mr-2"></i>{{$noti->title}}
                            </a>
                        @else
                            <a href="../page/notification/{{$noti->id}}" class="dropdown-item">
                                <i class="fas fa-clock mr-2"></i>{{$noti->title}}
                            </a>
                        @endif
                    @endforeach
                </div>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a href="../page/logout" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" role="button" onclick="fullScreen()">
                    <i class="fas fa-expand d-none" id="zoom-in"></i>
                    <i class="fas fa-expand-arrows-alt" id="zoom-out"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
<?php
    }
    if (Auth::User()->role == 1) {
?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-gray navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebar-toggle-btn" id="push-menu" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../admin/home" class="nav-link text-bold">
                    <i class="fas fa-home"></i>Home</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class=" nav navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <div class="navbar-search-block">
                    <form class="form-inline" action="../admin/search" method="post">
                        <div class="input-group input-group-sm">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input class="form-control form-control-navbar" type="search"
                                   placeholder="Search user" name='searchKey'>
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if($count > 0)
                        <span class="badge badge-warning navbar-badge">{{$count}}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-notifications">
                    <span class="dropdown-item dropdown-header"><?php
                        echo $count; ?> New Notifications</span>
                    <div class="dropdown-divider"></div>
                    @foreach ($getNoti as $noti)
                        @if($noti->status == 1)
                            <a href="../admin/notification/{{$noti->id}}" class="dropdown-item text-muted">
                                <i class="fas fa-clock mr-2"></i>
                                "{{$noti->user->user_name}}" {{$noti->title}}
                                <span class="float-right text-muted text-sm">{{$noti->content}}</span>
                            </a>
                        @else
                            <a href="../admin/notification/{{$noti->id}}" class="dropdown-item">
                                <i class="fas fa-clock mr-2"></i>
                                "{{$noti->user->user_name}}" {{$noti->title}}
                                <span class="float-right text-muted text-sm">{{$noti->content}}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </li>
            <!-- Logout -->
            <li class="nav-item">
                <a href="../page/logout" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" role="button" onclick="fullScreen()">
                    <i class="fas fa-expand d-none" id="zoom-in"></i>
                    <i class="fas fa-expand-arrows-alt" id="zoom-out"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
<?php } ?>
