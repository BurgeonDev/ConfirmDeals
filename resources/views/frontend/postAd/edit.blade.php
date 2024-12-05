@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Edit Ad</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Edit Ad</li>
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
                        <!-- Start Edit Ad Block Area -->
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
                            <h3 class="block-title">Edit Ad</h3>
                            <div class="inner-block">
                                <div class="post-ad-tab">
                                    <div class="step-one-content">
                                        <form class="default-form-style" method="post"
                                            action="{{ route('ad.update', $ad->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- Spoof PUT method for updating -->
                                            <div class="row">
                                                <!-- Title -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="title">Ad Title*</label>
                                                        <input name="title" type="text" id="title"
                                                            value="{{ old('title', $ad->title) }}"
                                                            placeholder="Enter Ad Title" required>
                                                        @error('title')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Description -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">Ad Description*</label>
                                                        <textarea name="description" id="description" placeholder="Enter Ad Description" required>{{ old('description', $ad->description) }}</textarea>
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
                                                                    {{ old('category_id', $ad->category_id) == $category->id ? 'selected' : '' }}>
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
                                                                {{ old('type', $ad->type) == 'service' ? 'selected' : '' }}>
                                                                Service
                                                            </option>
                                                            <option value="product"
                                                                {{ old('type', $ad->type) == 'product' ? 'selected' : '' }}>
                                                                Product
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Price -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price">Price</label>
                                                        <input name="price" type="number" id="price"
                                                            value="{{ old('price', $ad->price) }}"
                                                            placeholder="Enter Price">
                                                        @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- Coins Needed -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="coins_needed">Coins Needed*</label>
                                                        <input name="coins_needed" type="number" id="coins_needed"
                                                            value="{{ old('coins_needed', $ad->coins_needed) }}"
                                                            placeholder="Enter Coins Needed" readonly required>

                                                        <div id="liveError" class="text-danger">
                                                            @error('coins_needed')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
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
                                                                    {{ old('country_id', $ad->country_id) == $country->id ? 'selected' : '' }}>
                                                                    {{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- City -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="city_id">City*</label>
                                                        <select name="city_id" id="city_id" class="user-chosen-select"
                                                            required>
                                                            <option value="">Select City</option>
                                                            @foreach ($ad->country->cities ?? [] as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('city_id', $ad->city_id) == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Locality -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="locality_id">Locality</label>
                                                        <select name="locality_id" id="locality_id"
                                                            class="user-chosen-select">
                                                            <option value="">Select Locality</option>
                                                            @foreach ($ad->city->localities ?? [] as $locality)
                                                                <option value="{{ $locality->id }}"
                                                                    {{ old('locality_id', $ad->locality_id) == $locality->id ? 'selected' : '' }}>
                                                                    {{ $locality->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Old Pictures Section -->


                                                <div class="col-12">
                                                    <div class="form-group upload-image">
                                                        <label for="pictures">Upload Pictures</label>
                                                        <input type="file" id="pictures" name="pictures[]" multiple
                                                            accept=".jpg,.jpeg,.png" placeholder="Upload Image"
                                                            onchange="validateFileLimit(this)">
                                                        <span>Can add multiple pictures. Supported formats: JPG, PNG
                                                            (Max:
                                                            5)</span>
                                                        @error('pictures')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="uploaded-images">
                                                        <label>Current Images:</label>
                                                        <div class="row">
                                                            @foreach ($ad->pictures as $picture)
                                                                <div class="col-3">
                                                                    <img src="{{ asset('storage/' . $picture) }}"
                                                                        alt="Uploaded Image" class="mb-2 img-fluid">

                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Submit Button -->
                                                <div class="col-12">
                                                    <div class="mb-0 form-group button">
                                                        <button type="submit" class="btn">Update Ad</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Ad Block Area -->
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
        function validateFileLimit(input) {
            if (input.files.length > 5) {
                alert("You can upload a maximum of 5 pictures.");
                input.value = ""; // Clear the selected files
            }
        }
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
        document.getElementById('price').addEventListener('input', function() {
            let price = parseFloat(this.value);
            let coinsNeeded = 0;

            if (price <= 1000) {
                coinsNeeded = Math.ceil((price * 0.025) / 50);
            } else if (price <= 3000) {
                coinsNeeded = Math.ceil((price * 0.03) / 50);
            } else if (price <= 5000) {
                coinsNeeded = Math.ceil((price * 0.05) / 50);
            } else if (price <= 10000) {
                coinsNeeded = Math.ceil((price * 0.10) / 50);
            } else {
                coinsNeeded = Math.ceil((price * 0.15) / 50);
            }

            document.getElementById('coins_needed').value = coinsNeeded;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('price');
            const coinsNeededInput = document.getElementById('coins_needed');
            const liveErrorDiv = document.getElementById('liveError');

            // Update coins_needed dynamically based on price
            priceInput.addEventListener('input', function() {
                const price = parseFloat(priceInput.value) || 0;

                // Calculate coins needed (example: 10 coins per price unit)
                const coinsNeeded = Math.ceil(price / 10); // Adjust logic as needed
                coinsNeededInput.value = coinsNeeded;

                // Validate user's coin balance
                validateUserCoins(coinsNeeded);
            });

            // Function to validate user's coin balance via AJAX
            function validateUserCoins(coinsNeeded) {
                fetch('{{ route('validate.coins') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            coins_needed: coinsNeeded
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.valid) {
                            liveErrorDiv.textContent = data.message;
                        } else {
                            liveErrorDiv.textContent = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
