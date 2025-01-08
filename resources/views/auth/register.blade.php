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
                                    <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}"
                                        required autofocus autocomplete="first_name" class="form-control"
                                        placeholder="First Name">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}"
                                        required autofocus autocomplete="last_name" class="form-control"
                                        placeholder="Last Name">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="form-group col-md-12">
                                <input id="phone_number" name="phone_number" type="text"
                                    value="{{ old('phone_number') }}" required autofocus autocomplete="phone_number"
                                    class="form-control" placeholder="Phone Number 03XX-XXXXXXX">
                                @if ($errors->has('phone_number'))
                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                    autocomplete="email" class="form-control" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>


                            <!-- Profession -->
                            <div class="form-group">
                                <select id="profession" name="profession" class="form-control" required>
                                    <option value="">Select Profession</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}"
                                            {{ old('profession') == $profession->id ? 'selected' : '' }}>
                                            {{ $profession->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('profession'))
                                    <span class="text-danger">{{ $errors->first('profession') }}</span>
                                @endif
                            </div>

                            <div class="row">
                                <!-- Country -->
                                <div class="form-group col-md-4">
                                    <select name="country_id" id="country_id" class="form-control" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country_id'))
                                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                                    @endif
                                </div>

                                <!-- City -->
                                <div class="form-group col-md-4">
                                    <select name="city_id" id="city_id" class="form-control" required>
                                        <option value="">Select City</option>
                                        @if (old('country_id'))
                                            @foreach ($cities as $city)
                                                @if ($city->country_id == old('country_id'))
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Locality -->
                                <div class="form-group col-md-4">
                                    <select name="locality_id" id="locality_id" class="form-control">
                                        <option value="">Select Locality</option>
                                        @if (old('city_id'))
                                            @foreach ($localities as $locality)
                                                @if ($locality->city_id == old('city_id'))
                                                    <option value="{{ $locality->id }}"
                                                        {{ old('locality_id') == $locality->id ? 'selected' : '' }}>
                                                        {{ $locality->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('locality_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input id="password" name="password" type="password" required autocomplete="new-password"
                                    class="form-control" placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    autocomplete="new-password" class="form-control" placeholder="Confirm Password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="check-and-pass">
                                <div class="form-check">
                                    <input id="terms" name="terms" type="checkbox" class="form-check-input"
                                        required>
                                    <label for="terms" class="form-check-label">
                                        Agree to our <a href="{{ route('terms') }}">Terms and Conditions</a>
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
