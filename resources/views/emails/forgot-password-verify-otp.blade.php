@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>OTP Verification</h3>
                            <p>We have sent OTP on your email</p>
                            <hr>
                        </div>
                        <div class="otp-icon"><img src="images/otp-img.png" class="img-fluid" alt="otp icon"></div>
                        <div class="sign_up_form">
                            <form action="{{ route('auth.forgotPasswordVerification') }}" method="POST">
                                @csrf
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" id="phone" name="otp"
                                        placeholder="Enter verification code">
                                </div>
                                <span class="style-1">Didn’t receive code? <a href="#"> Request again</a></span>
                                @if (session('error'))
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
@endsection
