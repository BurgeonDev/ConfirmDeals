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
                                            enctype="multipart/form-data" class="default-form-style">
                                            @csrf
                                            @method('post')
                                            <div class="row">
                                                <!-- Existing Profile Picture -->
                                                <div class="mb-3 col-12">
                                                    <div class="text-center form-group">
                                                        <label for="current_profile_pic">@lang('messages.current_profile_pic')</label>
                                                        <div class="mb-2">
                                                            <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('default-profile-pic.png') }}"
                                                                alt="Profile Picture" class="img-thumbnail"
                                                                style="max-width: 150px;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Profile Picture Upload -->
                                                <div class="col-12">
                                                    <div class="form-group upload-image">
                                                        <label for="profile_pic">@lang('messages.upload_new_profile_pic')</label>
                                                        <input name="profile_pic" type="file" class="form-control">
                                                        @error('profile_pic')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- First Name -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="first_name">@lang('messages.first_name')</label>
                                                            <input name="first_name" type="text" class="form-control"
                                                                value="{{ old('first_name', $user->first_name) }}" required>
                                                            @error('first_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Last Name -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="last_name">@lang('messages.last_name')</label>
                                                            <input name="last_name" type="text" class="form-control"
                                                                value="{{ old('last_name', $user->last_name) }}" required>
                                                            @error('last_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Email -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="email">@lang('messages.email')</label>
                                                            <input name="email" type="email" class="form-control"
                                                                value="{{ old('email', $user->email) }}" required>
                                                            @error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!-- Phone Number -->
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="phone_number">@lang('messages.phone_no')</label>
                                                            <input name="phone_number" type="tel" class="form-control"
                                                                value="{{ old('phone_number', $user->phone_number ?? '') }}"
                                                                required>
                                                            @error('phone_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Profession Selector -->
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="profession_id">@lang('messages.profession')</label>
                                                            <select name="profession_id" id="profession_id"
                                                                class="form-control" required>
                                                                <option value="" disabled selected>Select your
                                                                    profession</option>
                                                                @foreach ($professions as $profession)
                                                                    <option value="{{ $profession->id }}"
                                                                        {{ old('profession_id', $user->profession_id) == $profession->id ? 'selected' : '' }}>
                                                                        {{ $profession->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('profession_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <!-- Country -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="country_id">@lang('messages.country')</label>
                                                        <select name="country_id" id="country_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}"
                                                                    {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- City -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="city_id">@lang('messages.city')</label>
                                                        <select name="city_id" id="city_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select City</option>
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Locality -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="locality_id">@lang('messages.locality')</label>
                                                        <select name="locality_id" id="locality_id"
                                                            class="user-chosen-select">
                                                            <option value="">Select Locality</option>
                                                        </select>
                                                        @error('locality_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div> --}}
                                                <!-- Country -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="country_id">@lang('messages.country')</label>
                                                        <select name="country_id" id="country_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}"
                                                                    {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('country_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- City -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="city_id">@lang('messages.city')</label>
                                                        <select name="city_id" id="city_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select City</option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('city_id', $user->city_id) == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Locality -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="locality_id">@lang('messages.locality')</label>
                                                        <select name="locality_id" id="locality_id"
                                                            class="user-chosen-select">
                                                            <option value="">Select Locality</option>
                                                            @foreach ($localities as $locality)
                                                                <option value="{{ $locality->id }}"
                                                                    {{ old('locality_id', $user->locality_id) == $locality->id ? 'selected' : '' }}>
                                                                    {{ $locality->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('locality_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="password">@lang('messages.password')</label>
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
                                                        <label for="password_confirmation">@lang('messages.confirm_password')</label>
                                                        <input name="password_confirmation" type="password"
                                                            class="form-control" placeholder="Confirm new password">
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-12">
                                                    <div class="mb-0 form-group button">
                                                        <button type="submit"
                                                            class="btn btn-primary">@lang('messages.update_profile')</button>
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
                        <div class="mt-3 dashboard-block close-content">
                            <h2>@lang('messages.delete_account')</h2>
                            <h4>@lang('messages.are_you_sure_delete')</h4>
                            <div class="button">
                                <form action="{{ route('userProfile.delete') }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">@lang('messages.delete_account_button')</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
    <script>
        const data = @json($countries); // Convert PHP data to JSON
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countrySelect = document.getElementById('country_id');
            const citySelect = document.getElementById('city_id');
            const localitySelect = document.getElementById('locality_id');

            // Fetch cities on country change
            countrySelect.addEventListener('change', function() {
                const countryId = this.value;

                citySelect.innerHTML = '<option value="">Select City</option>';
                localitySelect.innerHTML = '<option value="">Select Locality</option>';

                if (countryId) {
                    fetch(`/get-cities/${countryId}`)
                        .then(response => response.json())
                        .then(cities => {
                            cities.forEach(city => {
                                const option = new Option(city.name, city.id);
                                citySelect.add(option);
                            });
                        })
                        .catch(error => console.error('Error fetching cities:', error));
                }
            });

            // Fetch localities on city change
            citySelect.addEventListener('change', function() {
                const cityId = this.value;

                localitySelect.innerHTML = '<option value="">Select Locality</option>';

                if (cityId) {
                    fetch(`/get-localities/${cityId}`)
                        .then(response => response.json())
                        .then(localities => {
                            localities.forEach(locality => {
                                const option = new Option(locality.name, locality.id);
                                localitySelect.add(option);
                            });
                        })
                        .catch(error => console.error('Error fetching localities:', error));
                }
            });
        });
    </script>

@endsection
