@extends('frontend.layouts.app')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Login</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- start login section -->
    <section class="login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="form-head">
                        <h4 class="title">Login</h4>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Username or Email</label>
                                <input id="email" name="email" type="email" class="form-control"
                                    value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" class="form-control" required
                                    placeholder="Enter your password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="check-and-pass">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-check">
                                            <input type="hidden" class="form-check-input width-auto" id="remember"
                                                name="remember">

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="lost-pass">Lost your
                                                password?</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn">Login Now</button>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            <div class="socila-login">
                                <ul>
                                    <li><a href="{{ route('social.redirect', 'facebook') }}" class="facebook">
                                            <i class="lni lni-facebook-original"></i>Login With Facebook
                                        </a></li>
                                    <li><a href="{{ route('social.redirect', 'google') }}" class="google">
                                            <i class="lni lni-google"></i>Login With Google
                                        </a></li>
                                </ul>
                            </div>

                            <p class="outer-link">Don't have an account? <a href="{{ route('register') }}">Register here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end login section -->
@endsection
