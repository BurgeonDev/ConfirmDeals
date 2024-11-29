@extends('frontend.layouts.app')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Registeration</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Register</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- End Breadcrumbs -->

    <!-- start login section -->
    <section class="login registration section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="form-head">
                        <h4 class="title">Registration</h4 <!-- Registration Form -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}"
                                        required autofocus autocomplete="first_name" class="form-control"
                                        placeholder="First Name">
                                    <x-input-error :messages="$errors->get('first_name')" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}"
                                        required autofocus autocomplete="last_name" class="form-control"
                                        placeholder="Last Name">
                                    <x-input-error :messages="$errors->get('last_name')" />
                                </div>
                            </div>
                            <!-- phone -->
                            <div class="form-group col-md-12">
                                <label for="phone_number">Phone No</label>
                                <input id="phone_number" name="phone_number" type="text"
                                    value="{{ old('phone_number') }}" required autofocus autocomplete="phone_number"
                                    class="form-control" placeholder="Phone Number">
                                <x-input-error :messages="$errors->get('phone_number')" />
                            </div>
                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                    autocomplete="email" class="form-control" placeholder="Email">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" type="password" required autocomplete="new-password"
                                    class="form-control" placeholder="Password">
                                <x-input-error :messages="$errors->get('password')" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    autocomplete="new-password" class="form-control" placeholder="Confirm Password">
                                <x-input-error :messages="$errors->get('password_confirmation')" />
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="check-and-pass">
                                <div class="form-check">
                                    <input id="terms" name="terms" type="checkbox" class="form-check-input" required>
                                    <label for="terms" class="form-check-label">
                                        Agree to our <a href="javascript:void(0)">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="button">
                                <button type="submit" class="btn">Register Now</button>
                            </div>

                            <!-- Login Link -->
                            <p class="outer-link">
                                Already have an account? <a href="{{ route('login') }}">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
