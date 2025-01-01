<?php use App\Models\Setting; ?>
@extends('frontend.layouts.app')
@section('content')


    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Ads</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Ads</li>
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
                        {{-- @if (auth()->user()->coins >= 20) --}}
                        <!-- Start Post Ad Block Area -->
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
                            {{-- <h3 class="block-title">Post Ad</h3> --}}
                            <h3 class="block-title">{{ __('messages.post_ad') }}</h3>
                            <div class="inner-block">
                                <div class="post-ad-tab">
                                    <div class="step-one-content">
                                        <!-- Start Post Ad Content -->
                                        <form class="default-form-style" method="post" action="{{ route('ad.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <!-- Title -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title">{{ __('messages.ad_title') }}</label>
                                                        <input name="title" type="text" id="title"
                                                            placeholder="{{ __('messages.enter_ad_title') }}" required
                                                            value="{{ old('title') }}">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">{{ __('messages.ad_description') }}</label>
                                                        <textarea name="description" id="description" placeholder="{{ __('messages.enter_ad_description') }}" required>{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Category -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="category_id">{{ __('messages.category') }}</label>
                                                        <select name="category_id" id="category_id"
                                                            class="user-chosen-select" required>
                                                            <option value="">{{ __('messages.select_category') }}
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Ad Type -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="type">{{ __('messages.ad_type') }}</label>
                                                        <select name="type" id="type" class="user-chosen-select"
                                                            required>
                                                            <option value="">{{ __('messages.select_ad_type') }}
                                                            </option>
                                                            <option value="service"
                                                                {{ old('type') == 'service' ? 'selected' : '' }}>
                                                                {{ __('service') }}
                                                            </option>
                                                            <option value="product"
                                                                {{ old('type') == 'product' ? 'selected' : '' }}>
                                                                {{ __('product') }}
                                                            </option>
                                                        </select>
                                                        @error('type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Price -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="price">{{ __('messages.price') }}</label>
                                                            <input name="price" type="number" id="price"
                                                                placeholder="{{ __('messages.enter_price') }}"
                                                                value="{{ old('price') }}">
                                                            <span class="text-danger" id="priceError"></span>
                                                        </div>
                                                    </div>
                                                    <!-- Coins Needed -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="days_featured">Total Coins Required</label>
                                                            <input type="number" id="total_coins" disabled />
                                                            <div id="liveError" class="text-danger"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <!-- Featured Ad -->
                                                        <div class="form-group"
                                                            style="text-align: center;>
                                                            <div
                                                                style="display:
                                                            inline-flex; align-items: center; gap: 8px;">
                                                            <label for="is_featured" style="font-size: 16px;">Feature
                                                                this ad</label>
                                                            <input type="checkbox" name="is_featured" id="is_featured"
                                                                value="1" style="width: 50px; height: 50px;">

                                                        </div>
                                                        @error('is_featured')
                                                            <div class="text-danger" style="margin-top: 4px;">
                                                                {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- Featured Days -->
                                                    <div id="featured-options" style="display:none;">
                                                        <div class="form-group">
                                                            <label for="days_featured">Featured Days:</label>
                                                            <input type="number" name="days_featured" id="days_featured"
                                                                min="1">
                                                            @error('days_featured')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <span id="liveErrors"></span>
                                                        </div>
                                                    </div>
                                                    <!-- Total Coins -->
                                                    <div class="form-group" style="display:none;">
                                                        <input name="coins_needed" type="number" id="coins_needed"
                                                            readonly value="{{ old('coins_needed') }}" hidden>
                                                        <input type="text" id="additional_coins" disabled hidden />
                                                        @error('coins_needed')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!-- Country -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="country_id">{{ __('messages.country') }}</label>
                                                        <select name="country_id" id="country_id"
                                                            class="user-chosen-select" required>
                                                            <option value="">{{ __('messages.select_country') }}
                                                            </option>
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
                                                        <label for="city_id">{{ __('messages.city') }}</label>
                                                        <select name="city_id" id="city_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">{{ __('messages.select_city') }}
                                                            </option>
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('city_id') == $city->id ? 'selected' : '' }}>
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
                                                        <label for="locality_id">{{ __('messages.locality') }}</label>
                                                        <select name="locality_id" id="locality_id"
                                                            class="user-chosen-select">
                                                            <option value="">{{ __('messages.select_locality') }}
                                                            </option>
                                                            @foreach ($localities as $locality)
                                                                <option value="{{ $locality->id }}"
                                                                    {{ old('locality_id') == $locality->id ? 'selected' : '' }}>
                                                                    {{ $locality->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('locality_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Upload Pictures -->
                                            <div class="col-12">
                                                <div class="form-group upload-image">
                                                    <label for="pictures">{{ __('messages.upload_pictures') }}</label>
                                                    <input type="file" id="pictures" name="pictures[]" multiple
                                                        accept=".jpg,.jpeg,.png"
                                                        placeholder="{{ __('messages.upload_image') }}"
                                                        onchange="validateFileLimit(this)">
                                                    <span>{{ __('messages.multiple_pictures_info') }}</span>
                                                    @error('pictures')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12">
                                                <div class="mb-0 form-group button">
                                                    <button type="submit"
                                                        class="btn">{{ __('messages.post_ad_button') }}</button>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Preload data for filtering -->
    <script>
        const data = @json($countries); // Convert PHP data to JSON
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countriesData = data;
            const countrySelect = document.getElementById('country_id');
            const citySelect = document.getElementById('city_id');
            const localitySelect = document.getElementById('locality_id');

            // Event listener for country selection
            countrySelect.addEventListener('change', function() {
                const selectedCountryId = this.value;

                // Clear previous options
                citySelect.innerHTML = '<option value="">Select City</option>';
                localitySelect.innerHTML = '<option value="">Select Locality</option>';

                if (selectedCountryId) {
                    const country = countriesData.find(c => c.id == selectedCountryId);
                    if (country) {
                        country.cities.forEach(city => {
                            const option = new Option(city.name, city.id);
                            citySelect.add(option);
                        });
                    }
                }
            });

            // Event listener for city selection
            citySelect.addEventListener('change', function() {
                const selectedCityId = this.value;

                // Clear previous options
                localitySelect.innerHTML = '<option value="">Select Locality</option>';

                if (selectedCityId) {
                    const selectedCountryId = countrySelect.value;
                    const country = countriesData.find(c => c.id == selectedCountryId);
                    if (country) {
                        const city = country.cities.find(city => city.id == selectedCityId);
                        if (city) {
                            city.localities.forEach(locality => {
                                const option = new Option(locality.name, locality.id);
                                localitySelect.add(option);
                            });
                        }
                    }
                }
            });
        });
    </script>

    <script>
        function validateFileLimit(input) {
            if (input.files.length > 5) {
                alert("You can upload a maximum of 5 pictures.");
                input.value = ""; // Clear the selected files
            }
        }
    </script>
    <script>
        // When price field changes
        document.getElementById('price').addEventListener('input', function() {
            const price = parseFloat(this.value);
            const coinsNeededInput = document.getElementById('coins_needed');
            const liveError = document.getElementById('liveError');
            const totalCoinsInput = document.getElementById('total_coins');
            const additionalCoinsInput = document.getElementById('additional_coins');

            if (!price || price <= 0) {
                coinsNeededInput.value = ''; // Reset value
                liveError.textContent = 'Enter a valid price.';
                return;
            }

            // Fetch the PKR price of 1 coin and user's coin balance
            fetch('/get-coin-price-and-balance')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        liveError.textContent = data.error;
                        coinsNeededInput.value = ''; // Reset value
                        totalCoinsInput.value = ''; // Reset total coins
                        return;
                    }

                    liveError.textContent = '';
                    // Calculate coins needed from price
                    const coinsForPrice = Math.ceil(price / data.price_in_pkr);
                    coinsNeededInput.value = coinsForPrice;

                    // Update the total coins (coins_needed + additional_coins)
                    updateTotalCoins();

                    // Check if the user has enough coins
                    if (data.user_balance < coinsForPrice + parseInt(additionalCoinsInput.value || 0)) {
                        liveError.textContent =
                            `You do not have enough coins. You need ${coinsForPrice + parseInt(additionalCoinsInput.value || 0)} coins, but only have ${data.user_balance}.`;
                    } else {
                        liveError.textContent = ''; // Clear error if enough coins
                    }
                })
                .catch(() => {
                    liveError.textContent = 'Error fetching coin price or user balance. Please try again.';
                });
        });

        // When the 'is_featured' checkbox changes
        document.getElementById('is_featured').addEventListener('change', function() {
            const featuredOptions = document.getElementById('featured-options');
            const daysFeaturedInput = document.getElementById('days_featured');
            const additionalCoinsInput = document.getElementById('additional_coins');
            const liveError = document.getElementById('liveError');

            if (this.checked) {
                featuredOptions.style.display = 'block'; // Show featured options
            } else {
                featuredOptions.style.display = 'none'; // Hide featured options
                daysFeaturedInput.value = ''; // Reset featured days
                additionalCoinsInput.value = ''; // Reset additional coins
                liveError.textContent = ''; // Clear error message
                updateTotalCoins(); // Update total coins
            }
        });

        // When the featured days field changes
        document.getElementById('days_featured').addEventListener('input', function() {
            const days = parseInt(this.value);
            const featuredAdRate = @json($featuredAdRate ?? 0); // Ensure the correct value
            const additionalCoinsInput = document.getElementById('additional_coins');
            const liveError = document.getElementById('liveError');

            if (!days || days <= 0) {
                liveError.textContent = 'Enter a valid number of days.';
                additionalCoinsInput.value = ''; // Reset additional coins if input is invalid
                updateTotalCoins(); // Update total coins
                return;
            }

            // Calculate additional coins needed for featured days
            const additionalCoins = featuredAdRate * days;
            additionalCoinsInput.value = additionalCoins;
            liveError.textContent = `Additional coins required: ${additionalCoins}`; // Display live error message

            // Update total coins (coins_needed + additional_coins)
            updateTotalCoins();
        });

        // Function to update the total coins field
        function updateTotalCoins() {
            const coinsNeeded = parseInt(document.getElementById('coins_needed').value) || 0;
            const additionalCoins = parseInt(document.getElementById('additional_coins').value) || 0;
            const totalCoinsInput = document.getElementById('total_coins');
            const liveError = document.getElementById('liveError');

            const totalCoins = coinsNeeded + additionalCoins;
            totalCoinsInput.value = totalCoins;

            // Fetch the user's coin balance and check if they have enough coins
            fetch('/get-coin-price-and-balance')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        liveError.textContent = data.error;
                        return;
                    }

                    // Check if the user has enough coins
                    if (data.user_balance < totalCoins) {
                        liveError.textContent =
                            `You do not have enough coins. You need ${totalCoins} coins, but only have ${data.user_balance}.`;
                    } else {
                        liveError.textContent = ''; // Clear error if enough coins
                    }
                })
                .catch(() => {
                    liveError.textContent = 'Error fetching coin price or user balance. Please try again.';
                });
        }
    </script>




@endsection
