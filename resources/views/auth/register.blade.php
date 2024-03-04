@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>Sign up</h3>
                            <p>Please sign up to continue</p>
                            <hr>
                        </div>
                        <div class="sign_up_form">
                            <ul class="nav nav-pills mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation"> <a class="nav-link" id="pills-email-tab"
                                    data-toggle="pill" href="#pills-email" name="email" role="tab"
                                    aria-controls="pills-email" aria-selected="false">Email</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link active" id="pills-phone-tab"
                                        data-toggle="pill" href="#pills-phone" role="tab" aria-controls="pills-phone"
                                        aria-selected="true">Phone</a> </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="pills-phone" role="tabpanel"
                                    aria-labelledby="pills-phone-tab">
                                    <form action="#">
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" id="phone"
                                                placeholder="Phone Number">
                                        </div>
                                        <span class="style-1"><a href="#">Do you have a security code?</a></span>
                                        <button type="submit" class="btn-log theme-btn">Sign Up</button>
                                        <span class="style-1">Already a member?<a href="{{ route('auth.login') }}"> Log in</a></span>
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
                                    <form action="{{ route('auth.step1register') }}" method="POST">
                                        @csrf

                                        <div class="form-group input-group">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Email Address" name="email">
                                        </div>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <span class="style-1"><a href="#">Do you have a security code?</a></span>

                                        <button type="submit" class="btn-log theme-btn">Sign Up</button>

                                        <span class="style-1">Already a member?<a href="{{ route('auth.login') }}"> Log in</a></span>

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
