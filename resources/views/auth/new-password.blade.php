@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="login-page">
                        <div class="title-head text-center">
                            <h3>Create New Password</h3>
                            <p>Your new password must be diffrent from previously used password.</p>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <hr>
                        </div>
                        <div class="sign_up_form">
                            <form action="#">
                                <div class="form-group input-group">
                                    <input type="password" class="form-control" id="n-pwd"
                                        placeholder="Type New Password">
                                </div>
                                <span class="style-1 text-start">Must be at least 8 characters.</span>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control" id="c-pwd"
                                        placeholder="Confirm Password">
                                </div>
                                <span class="style-1 text-start">Must be at least 8 characters.</span>
                                <button type="submit" class="btn-log theme-btn">Save</button>
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
