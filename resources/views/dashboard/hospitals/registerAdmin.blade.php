@extends('layouts.dashboard')

@section('title', 'Register Hospital')

@section('content')
    <div class="row justify-content-center my-5">
        <span class="h4 text-success">Please Enter Details of the Hospital Administrator</span>
    </div>
    <div class="row justify-content-center mb-5">
        <div class="col-md-10 px-2">
            <div class="card border-success py-5">
                <div class="header">
                    <span class="h5 text-success"><strong>Step 2</strong></span>
                </div>
                <div class="body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hospital_id" value="{{$id}}">

                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="row justify-content-center mb-3">
                                    <span class="text-secondary">Upload Profile Picture</span>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div id="uploadImageBlock" class="border border-success w-100 p-5 d-flex align-center rounded-circle" onclick="document.getElementById('profile_pic').click()">
                                            <span class="text-success"><i class="fa fa-camera fa-2x"></i></span>
                                        </div>
                                        <img id="imagePreview" src="#" class="img img-fluid rounded-circle" onclick="document.getElementById('profile_pic').click()" hidden>
                                    </div>
                                    <input type="file" name="profile_pic" id="profile_pic" onchange="loadImagePreview('imagePreview', this);" hidden>
                                </div>
                                @error('profile_pic')
                                    <div class="row justify-content-center">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                @enderror
                            </div>
                            <div class="offset-md-1 col-md-7">
                                <div class="form-group">
                                    <label for="fullname" class="col col-form-label">{{ __('Fullname :') }}</label>
        
                                    <div class="col-md-10">
                                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>
        
                                        @error('fullname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col col-form-label">{{ __('E-Mail Address :') }}</label>
        
                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number" class="col col-form-label">{{ __('Phone Number :') }}</label>
        
                                    <div class="col-md-10">
                                        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required>
        
                                        @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col col-form-label">{{ __('OTP Password :') }}</label>
        
                                    <div class="col-md-10">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password" class="col col-form-label">{{ __('Confirm OTP Password :') }}</label>
        
                                    <div class="col-md-10">
                                        <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" onchange="checkPassword()" required>
        
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row justify-content-center mt-5">
                            <div class="col-6">
                                <button type="submit" id="submit" href="#" class="btn btn-success w-100 disabled">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection