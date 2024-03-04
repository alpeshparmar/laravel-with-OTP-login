@extends('layouts.master')

@section('content')
    <section class="page-wrap">
        <div class="container">
            <div class="login-page">
                <div class="row justify-content-center">
                    @if (session('successMessage'))
                        <div class="alert alert-success">
                            {{ session('successMessage') }}
                        </div>
                    @endif
                    @if ($errors->has('photo'))
                        <div class="alert alert-danger">{{ $errors->first('photo') }}</div>
                    @endif
                    <div class="col-sm-12 col-lg-6 col-xl-6">
                        <div class="title-head text-start">
                            <h3>Personal Details</h3>
                            <p>Enter your personal information</p>
                        </div>
                        <div class="sign_up_form edit-profile">
                            <form action="{{ route('user.userProfile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Name" value="{{ $userProfile->name }}">
                                <input class="form-control @error('dob') is-invalid @enderror" id="datepicker"
                                    name="dob" placeholder="Date of Birth"
                                    value="{{ $userProfile->dob ? \Carbon\Carbon::parse($userProfile->dob)->format('m/d/Y') : '' }}">

                                <div class="form-group input-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $userProfile->email }}">
                                </div>
                                <div class="form-group input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="pwd" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="file-upload-text">
                                        {{-- <div class="input-space">
                                            <label class="form-label">Upload Images</label>
                                            <a href="#" class="btn-pvt"><i class="far fa-lock"></i>Private</a>
                                            <div class="file-upload">
                                                <p>Upload your media </p>
                                                <input type="file" name="photo_1" class="image-upload">
                                            </div>
                                        </div> --}}
                                        <div class="upload-show-img">
                                            <div class="upload-wrap">
                                                @if (!empty($userImages) && count($userImages) > 0)
                                                <img id="targetImage" src="{{ asset('storage/' . $userImages[0]->photo) }}" alt="User Image">
                                                @else
                                                <p>No image found</p>
                                                @endif
                                                <div class="upload-show-img mt-3">
                                                    @foreach($userImages as $image)
                                                        <div class="upload-images">
                                                            <img src="{{ asset('storage/' . $image->photo) }}" alt="Image" class="clickable-image">
                                                        </div>
                                                    @endforeach
                                                    <div class="upload-images">
                                                        <a href="javascript:void(0);" class="btn-icon" id="addImageBtn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <input type="file" name="photo" id="imageInput" style="display: none;" accept="image/*">

                                                    <div id="selectedImageName"></div>
                                                </div>
                                            </div>




                                        </div>
                                        <h5>Put the main picture as first Image <br>
                                            Image Should be minimum 152 * 152 Supported File format JPG, PNG, SVG</h5>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div>
                                        <hr>
                                    </div>
                                    <button type="submit" class="theme-btn">Save and Continue</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-xl-6">
                        {{-- <div class="upload-wrap">
                            <img src="{{ asset('storage/' . $userProfile->photo_1) }}" alt="User Image">
                            <div class="upload-show-img mt-3">
                                <div class="upload-images"> <img src="images/booking-01.jpg" alt="Image"></div>
                                <div class="upload-images"> <img src="images/booking-01.jpg" alt="Image"></div>
                                <div class="upload-images"> <img src="images/booking-01.jpg" alt="Image"></div>
                                <div class="upload-images">
                                    <a href="javascript:void(0);" class="btn-icon" id="addImageBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                        </svg>
                                    </a>
                                </div>
                                <input type="file" name="photo" id="imageInput" style="display: none;" accept="image/*">
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
