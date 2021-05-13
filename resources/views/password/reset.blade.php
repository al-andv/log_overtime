@extends('index')
@section('title')
    Forgot password
@endsection

@section('content')
    <form action="forgot-password" method="POST" class="register-form pt-5" id="loginForm">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
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
            <div class="alert alert-success">
                {{session('global')}}
            </div>
        @endif
        <div class="form-group">
            <h4 class="pb-2">Reset password</h4>
            <div class="form-group">
                <div class="row pl-3">
                    <label>Enter your email</label>
                    <input type="text" name="email" class="border" placeholder="Your email">
                </div>
            </div>
            </div>
        <div class="form-button float-right text-bold">
            <a class="btn badge-light mr-2" href="login">Cancel</a>
            <button type="submit" class="btn text-white badge-info">Send reset link</button>
        </div>
    </form>
@endsection
