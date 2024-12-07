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
                        <h4 class="title">Registration</h4>
                        <!-- Registration Form -->
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

                            <!-- Profession -->
                            <div class="form-group">
                                <label for="profession">Profession</label>
                                <div class="selector-head">

                                    <select id="profession" name="profession" class="form-control" required>
                                        <option value="">Select Profession</option>
                                        @foreach ($professions as $profession)
                                            <option value="{{ $profession->id }}"
                                                {{ old('profession') == $profession->id ? 'selected' : '' }}>
                                                {{ $profession->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-input-error :messages="$errors->get('profession')" />
                            </div>
                            <div class="row">
                                <!-- Country -->
                                <div class="form-group col-md-4">
                                    <label for="country_id">Country*</label>
                                    <select name="country_id" id="country_id" class="form-control" required>
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
                                <!-- City -->
                                <div class="form-group col-md-4">
                                    <label for="city_id">City*</label>
                                    <select name="city_id" id="city_id" class="form-control" required>
                                        <option value="">Select City</option>
                                        <!-- Optionally load old value dynamically if available -->
                                    </select>
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Locality -->
                                <div class="form-group col-md-4">
                                    <label for="locality_id">Locality</label>
                                    <select name="locality_id" id="locality_id" class="form-control">
                                        <option value="">Select Locality</option>
                                        <!-- Optionally load old value dynamically if available -->
                                    </select>
                                    @error('locality_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

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
                                    <input id="terms" name="terms" type="checkbox" class="form-check-input"
                                        required>
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
