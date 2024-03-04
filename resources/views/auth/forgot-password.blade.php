@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>Forgot Password</h3>
                            <p>Enter your phone number or email for the verification proccess.</p>
                            <hr>
                        </div>
                        <div class="f-icon"><img src="images/pwd-icon.png" class="img-fluid" alt="icon"></div>
                        <div class="sign_up_form">
                            <form method="POST" action="{{ route('auth.forgotPasswordOtp') }}">
                                @csrf
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" id="phone" name="email" placeholder="Email or phone number">
                                </div>
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <button type="submit" class="btn-log theme-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe -->
    <section class="subscribe-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-lg-8 col-xl-8">
                    <div class="subscribe_form text-center">
                        <h3>Stay tuned for the release date</h3>
                        <p>Be the first person who will try gofriends and enjoy for 12 months free</p>
                        <form action="#" method="get">
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <input type="email" class="form-control" id="inlineFormInput"
                                        placeholder="Enter your email">
                                    <button type="submit" class="theme-btn">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
