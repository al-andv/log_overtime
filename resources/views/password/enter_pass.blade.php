@extends('index')
@section('title')
    Find account
@endsection
@section('content')

    <form action="reset-password/{{$token}}" method="POST" class="register-form pt-5" id="loginForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif
        @if (isset($error))
            <div class="alert border-danger text-danger">
                {{$error}}
            </div>
        @endif
        <h4>Choose a new password</h4>
        <input type="hidden" name="token" value="{{$token}}">
        <input type="hidden" name="email" value="{{$email}}">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"
                   class="border rounded">
        </div>
        <div class="form-group">
            <label for="password_again">Confirm password</label>
            <input type="password" name="password_again" id="password_again" placeholder="Password confirm"
                   class="border rounded">
            <span class="error-pass"></span>
        </div>

        <div class="form-group form-button float-right text-bold">
            <button type="submit" class="btn text-white badge-info">Reset password</button>
        </div>
    </form>

@endsection
@section('script')
    <script src="public/js/validate-add-user.js"></script>
@endsection
