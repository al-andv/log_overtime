@extends('index')
@section('title')
    Log in
@endsection

@section('content')
    <h2 class="form-title">Sign in</h2>
    <form action="page/login" method="POST" class="register-form" id="loginForm">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif

        @if (session('global'))
            <div class="alert alert-danger">
                {{session('global')}}
            </div>
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label class="lb-login" for="name">
                <i class="zmdi zmdi-account material-icons-name"></i>
            </label>
            <input type="text" name="name" id="name" placeholder="Your Name" value="<?php
                if (isset($_COOKIE['name']))
                    { echo $_COOKIE['name']; }?>">
        </div>
        <div class="form-group">
            <label class="lb-login" for="password"><i class="zmdi zmdi-lock"></i></label>
            <input type="password" name="password" id="password" placeholder="Password"
                   value="<?php
                        if (isset($_COOKIE['pass']))
                            { echo $_COOKIE['pass']; }?>">
            <i class="zmdi zmdi-eye-off field-icon toggle-password"></i>
        </div>

        <div class="form-group">
            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"
                <?php if(isset($_COOKIE['name'])) { echo 'checked="checked"'; }
                    else { echo ""; }?>>
            <label for="remember-me" class="label-agree-term">
                <span><span></span></span>Remember me
            </label>
        </div>
        <div class="form-group form-button">
            <input type="submit" class="btn btn-submit text-white badge-info" value="Log in">
        </div>
        <div class="col-12 text-center">
            <a class="font-italic" href="forgot-password">Reset Password ?</a>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("zmdi-eye");
             if ($('#password').attr("type") == "password") {
                 $('#password').attr("type", "text");
            } else {
                 $('#password').attr("type", "password");
            }
        });
    </script>
@endsection
