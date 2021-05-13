@extends('layout.index')

@section('title')
    Home
@endsection

@section('content')
    <!-- Main content -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item">Page</li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-lg-7">
                        <h1 class="text-uppercase text-white font-weight-bold">We're coming soon...</h1>
                    </div>
                    <div class="col-lg-7 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">
                            If you would like to contact to us.<br>
                            Please send to email
                            <a class="text-white font-italic" href="mailto:mail@domain.com"
                                onClick="javascript:window.open('mailto:mail@domain.com', 'Mail');
                                event.preventDefault()"> contact@allogical.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </header><br>
        <!-- Services-->
        <section class="page-section">
            <div class="container">
                <h2 class="ml-5 mr-5 rounded-circle badge-secondary text-center font-italic">Service</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-2">
                            <div class="badge-blue rounded-circle ml-5 mr-5">
                                <i class="fas fa-4x fa-laptop-code text-white mt-4 mb-4"></i>
                            </div>
                            <h4 class="h5 mt-2">Publishing software</h4>
                            <p class="text-justify text-muted m-1">Many diverse software options are currently
                                available for desktop publishing, including the market leaders</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-2">
                            <div class="badge-blue rounded-circle ml-5 mr-5">
                                <i class="fas fa-4x fa-star-of-david text-white mt-4 mb-4"></i>
                            </div>
                            <h4 class="h5 mt-2">Advertisement</h4>
                            <p class="text-justify text-muted m-1">This effect could be seen in improved trade or
                                boosted brand recognition, among many different metrics.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-2">
                            <div class="badge-blue rounded-circle ml-5 mr-5">
                                <i class="fas fa-4x fa-globe text-white mt-4 mb-4"></i>
                            </div>
                            <h4 class="h5 mt-2">Specialized design activities</h4>
                            <p class="text-justify text-muted m-1">Many diverse software options are currently
                                available for desktop publishing, including the market leaders</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-2">
                            <div class="badge-blue rounded-circle ml-5 mr-5">
                                <i class="fas fa-4x fa-laptop-house text-white mt-4 mb-4"></i>
                            </div>
                            <h4 class="h5 mt-2">Computer Programming</h4>
                            <p class="text-justify text-muted m-1">Many diverse software options are currently
                                available for desktop publishing, including the market leaders</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section mt-5" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Please In Touch!</h2>
                        <hr class="divider my-2">
                        <p class="text-muted mb-5">Give us a call or send us an email and we will
                            get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-3 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-1 text-muted"></i><br>
                        <a href="tel:0905841816">+84 905 841 816</a>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-1 text-muted"></i>
                        <a class="d-block" href="mailto:mail@domain.com"
                            onClick="javascript:window.open('mailto:mail@domain.com', 'Mail');event.preventDefault()">
                            contact@allogical.com</a>
                    </div>
                </div>
            </div>
        </section>
        <br>
    </div>
    <!-- /.content -->
@endsection
