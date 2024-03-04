@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>Enter Personal Details</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <hr>
                        </div>
                        @if(session('successMessage'))
                            <div class="alert alert-success">
                                {{ session('successMessage') }}
                            </div>
                        @endif
                        <div class="sign_up_form">
                            <form action="{{ route('auth.addUserDetail') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-group input-group">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="UserName">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control @error('dob') is-invalid @enderror" id="datepicker" name="dob" placeholder="Date of Birth">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" id="phone" name="mobile_number" placeholder="Mobile Number">
                                    @error('mobile_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" id="email" value="{{ $email }}" disabled>
                                </div>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="pwd" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="c-pwd" name="confirm_password" placeholder="Confirm Password">
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                    <label class="custom-control-label" for="exampleCheck1">By registering your account, you
                                        are agree to our
                                        <a href="#">Terms & Conditions</a></label>
                                </div>
                                <button type="submit" class="btn-log theme-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
