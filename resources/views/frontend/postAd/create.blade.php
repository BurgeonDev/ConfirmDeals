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
                            <h3 class="block-title">Post Ad</h3>
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
                                                        <label for="title">Ad Title*</label>
                                                        <input name="title" type="text" id="title"
                                                            placeholder="Enter Ad Title" required
                                                            value="{{ old('title') }}">
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">Ad Description*</label>
                                                        <textarea name="description" id="description" placeholder="Enter Ad Description" required>{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Category -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="category_id">Category*</label>
                                                        <select name="category_id" id="category_id"
                                                            class="user-chosen-select" required>
                                                            <option value="">Select Category</option>
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

                                                <!-- Type -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="type">Ad Type*</label>
                                                        <select name="type" id="type" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select Ad Type</option>
                                                            <option value="service"
                                                                {{ old('type') == 'service' ? 'selected' : '' }}>
                                                                Service
                                                            </option>
                                                            <option value="product"
                                                                {{ old('type') == 'product' ? 'selected' : '' }}>
                                                                Product
                                                            </option>
                                                        </select>
                                                        @error('type')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Price -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price">Price</label>
                                                        <input name="price" type="number" id="price"
                                                            placeholder="Enter Price">
                                                        <span class="text-danger" id="priceError"></span>
                                                    </div>
                                                </div>

                                                <!-- Coins Needed -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="coins_needed">Coins Needed*</label>

                                                        <input name="coins_needed" type="number" id="coins_needed"
                                                            readonly>
                                                        <div id="liveError" class="text-danger">
                                                        </div>
                                                        @error('coins_needed')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>


                                                <!-- Country -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="country_id">Country*</label>
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
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="city_id">City*</label>
                                                        <select name="city_id" id="city_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select City</option>
                                                            <!-- Optionally load old value dynamically if available -->
                                                        </select>
                                                        @error('city_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Locality -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="locality_id">Locality</label>
                                                        <select name="locality_id" id="locality_id"
                                                            class="user-chosen-select">
                                                            <option value="">Select Locality</option>
                                                            <!-- Optionally load old value dynamically if available -->
                                                        </select>
                                                        @error('locality_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Pictures -->
                                                <div class="col-12">
                                                    <div class="form-group upload-image">
                                                        <label for="pictures">Upload Pictures</label>
                                                        <input type="file" id="pictures" name="pictures[]" multiple
                                                            accept=".jpg,.jpeg,.png" placeholder="Upload Image"
                                                            onchange="validateFileLimit(this)">
                                                        <span>Can add multiple pictures. Supported formats: JPG, PNG
                                                            (Max: 5)</span>
                                                        @error('pictures')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <!-- Submit Button -->
                                                <div class="col-12">
                                                    <div class="mb-0 form-group button">
                                                        <button type="submit" class="btn">Post Ad</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- End Post Ad Content -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Post Ad Block Area -->
                        </div>
                        {{-- @else
                            <div class="mt-0 dashboard-block">
                                <h3 class="block-title">Post Ad</h3>
                                <div class="inner-block">
                                    <div class="post-ad-tab">
                                        <div class="step-one-content">
                                            <div class="single-list three">
                                                <div class="main-content">
                                                    <div class="mt-0 dashboard-block close-content">
                                                        <h2>Sorry <i class="lni lni-emoji-sad"></i></h2>
                                                        <h4>You do not have enough coins to post an ad. Please earn or
                                                            purchase more coins.</h4>
                                                        <div class="button">
                                                            <a href="{{ route('pricing') }}">
                                                                <button type="submit" class="btn btn-danger">Buy
                                                                    Coins <i style="color: goldenrod"
                                                                        class="fas fa-coins"></i></button>
                                                            </a>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}


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
        document.getElementById('price').addEventListener('input', function() {
            const price = parseFloat(this.value);
            const coinsNeededInput = document.getElementById('coins_needed');
            const liveError = document.getElementById('liveError');

            if (!price || price <= 0) {
                coinsNeededInput.value = '';
                liveError.textContent = 'Enter a valid price.';
                return;
            }

            // Fetch the PKR price of 1 coin and user's coin balance
            fetch('/get-coin-price-and-balance')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        liveError.textContent = data.error;
                        coinsNeededInput.value = '';
                    } else {
                        liveError.textContent = '';
                        // Calculate coins needed
                        const coinsNeeded = Math.ceil(price / data.price_in_pkr);
                        coinsNeededInput.value = coinsNeeded;

                        // Check if the user has enough coins
                        if (data.user_balance < coinsNeeded) {
                            liveError.textContent =
                                `You do not have enough coins. You need ${coinsNeeded} coins, but only have ${data.user_balance}.`;
                        } else {
                            liveError.textContent = '';
                        }
                    }
                })
                .catch(() => {
                    liveError.textContent = 'Error fetching coin price or user balance. Please try again.';
                });
        });
    </script>
@endsection
