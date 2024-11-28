@extends('frontend.layouts.app')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Reset Password</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Reset Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- End Breadcrumbs -->
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="login registration section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="form-head">
                        <h4 class="title">Reset Password</h4>
                        <p class="subtitle">Enter your email address, and we'll send you a link to reset your password.</p>
                        <form method="POST" action="{{ route('password.email') }}" class="pt-3">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control form-control-lg"
                                    value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4 button">
                                <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>

                            <!-- Back to Login -->
                            <div class="mt-4 text-center fw-light">
                                <a href="{{ route('login') }}" class="text-primary">Back to Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
