@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Profile</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="main-content">

                        <div class="mt-0 dashboard-block">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h3 class="block-title">Update Profile</h3>
                            <div class="inner-block">
                                <div class="post-ad-tab">
                                    <div class="step-one-content">
                                        <form method="post" action="{{ route('userProfile.update') }}"
                                            class="default-form-style">
                                            @csrf
                                            @method('post')
                                            <div class="row">
                                                <!-- Name -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name*</label>
                                                        <input name="first_name" type="text" class="form-control"
                                                            value="{{ old('first_name', $user->first_name) }}" required>
                                                        @error('first_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name*</label>
                                                        <input name="last_name" type="text" class="form-control"
                                                            value="{{ old('last_name', $user->last_name) }}" required>
                                                        @error('last_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <!-- Email -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="email">Email*</label>
                                                        <input name="email" type="email" class="form-control"
                                                            value="{{ old('email', $user->email) }}" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input name="password" type="password" class="form-control"
                                                            placeholder="Enter new password (leave empty to keep current)">
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input name="password_confirmation" type="password"
                                                            class="form-control" placeholder="Confirm new password">
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12">
                                                    <div class="mb-0 form-group button">
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Profile</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="mt-0 dashboard-block close-content">
                            <h2>Delete Your Account</h2>
                            <h4>Are you sure, you want to delete your account?</h4>
                            <div class="button">
                                <form action="{{ route('userProfile.delete') }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
