@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>Sign In</h3>
                            <p>Please sign in to continue</p>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <hr>
                        </div>
                        <div class="sign_up_form">
                            <ul class="nav nav-pills mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-user-tab"
                                        data-toggle="pill" href="#pills-user" role="tab" aria-controls="pills-user"
                                        aria-selected="true">User Name</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link" id="pills-email-tab"
                                        data-toggle="pill" href="#pills-email" role="tab" aria-controls="pills-email"
                                        aria-selected="false">Email</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link" id="pills-phone-tab"
                                        data-toggle="pill" href="#pills-phone" role="tab" aria-controls="pills-phone"
                                        aria-selected="true">Phone</a> </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="pills-user" role="tabpanel"
                                    aria-labelledby="pills-user-tab">
                                    <form action="{{ route('auth.userLogin') }}" method="post">
                                        @csrf
                                        <div class="form-group input-group">
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                name="username" placeholder="User Name" value="{{ old('username') }}">
                                        </div>
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group input-group">
                                            <input type="password" class="form-control" id="pwd" name="password"
                                                placeholder="Password">
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <div class="form-group custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="exampleCheck1"
                                                name="remember">
                                            <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                                            <!-- You can add a link to handle forgot password here -->
                                            <a class="f-pwd" href="{{ route('auth.forgotPassword') }}">Forgot password?</a>
                                        </div>
                                        <button type="submit" class="btn-log theme-btn">Sign In</button>
                                        <span class="style-1">Don’t have an account?<a href="{{ route('auth.register') }}">
                                                Sign up</a></span>
                                        <div class="or"><span>Or</span></div>
                                        <div class="social-icons mt-2 clearfix">
                                            <ul>
                                                <li> <a href="#"> <i class="lab la-facebook-square"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-apple"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-instagram"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-twitter-square"></i> </a> </li>
                                            </ul>
                                        </div>
                                    </form>


                                </div>
                                <div class="tab-pane fade" id="pills-email" role="tabpanel"
                                    aria-labelledby="pills-email-tab">
                                    <form action="{{ route('auth.step1Login') }}" method="post">
                                        @csrf
                                        <div class="form-group input-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email Address" required>
                                        </div>
                                        <button type="submit" class="btn-log theme-btn">Sign In</button>
                                        <span class="style-1">Don’t have an account?<a href="{{ route('auth.register') }}">
                                                Sign up</a></span>
                                        <div class="or"><span>Or</span></div>
                                        <div class="social-icons mt-2 clearfix">
                                            <ul>
                                                <li> <a href="#"> <i class="lab la-facebook-square"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-apple"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-instagram"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-twitter-square"></i> </a> </li>
                                            </ul>
                                        </div>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="pills-phone" role="tabpanel"
                                    aria-labelledby="pills-phone-tab">
                                    <form action="#">
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" id="phone"
                                                placeholder="Phone Number">
                                        </div>
                                        <button type="submit" class="btn-log theme-btn">Sign In</button>
                                        <span class="style-1">Don’t have an account?<a
                                                href="{{ route('auth.register') }}"> Sign up</a></span>
                                        <div class="or"><span>Or</span></div>
                                        <div class="social-icons mt-2 clearfix">
                                            <ul>
                                                <li> <a href="#"> <i class="lab la-facebook-square"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-apple"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-instagram"></i> </a> </li>
                                                <li> <a href="#"> <i class="lab la-twitter-square"></i> </a> </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
