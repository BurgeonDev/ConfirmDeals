@extends('frontend.layouts.app')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Email Verification</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Email Verification</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Verification Section -->
    <section class="py-5 verification section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="p-5 text-center bg-white rounded-lg shadow-lg form-head">
                        <h4 class="mb-3 title">Thanks for signing up!</h4>
                        <p class="mb-4 text-muted">
                            {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 alert alert-success">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <!-- Resend Verification Email Form -->
                        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                            @csrf
                            <button type="submit" class="py-2 btn btn-primary w-100">Resend Verification Email</button>
                        </form>

                        <!-- Log Out Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="py-2 btn btn-outline-secondary w-100">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Verification Section -->
@endsection
