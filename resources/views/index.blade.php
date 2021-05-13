<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <base href="{{asset('')}}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Log time | @yield('title')</title>

        <!-- Font Icon -->
        <link rel="stylesheet" href="public/login/fonts/material-icon/css/material-design-iconic-font.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- Main css -->
        <link rel="stylesheet" href="public/login/css/style.css">
    </head>
    <body>
        <div class="main">
            <!-- Sing in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure>
                                <img src="public/login/images/signup-image.jpg" alt="sing up image">
                            </figure>
                        </div>

                        <div class="signin-form">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="public/js/jquery-3.3.1.min.js"></script>
        <script src="public/js/jquery.validate.min.js"></script>
        @yield('script')
    </body>
</html>
