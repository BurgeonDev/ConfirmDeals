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
                                                    </div>
                                                </div>
                                                <!-- Description -->
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description">Ad Description*</label>
                                                        <textarea name="description" id="description" placeholder="Enter Ad Description" required>{{ old('description', $ad->description) }}</textarea>
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
                                                    </div>
                                                </div>
                                                <!-- Coins Needed -->
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="coins_needed">Coins Needed*</label>
                                                        <input name="coins_needed" type="number" id="coins_needed"
                                                            value="{{ old('coins_needed', $ad->coins_needed) }}"
                                                            placeholder="Enter Coins Needed" required>
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
                                                <div class="form-group">
                                                    <label>Existing Pictures</label>
                                                    <div class="row">
                                                        @if (!empty($oldPictures) && is_array($oldPictures))
                                                            @foreach ($oldPictures as $picture)
                                                                <div class="mb-2 col-4">
                                                                    <img src="{{ asset('storage/' . $picture) }}"
                                                                        alt="Ad Picture" class="img-thumbnail"
                                                                        style="width: 100%; height: auto;">
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <p>No pictures uploaded yet.</p>
                                                        @endif

                                                    </div>
                                                </div>

                                                <!-- File Upload -->
                                                <div class="form-group">
                                                    <label for="pictures">Upload New Pictures</label>
                                                    <input type="file" id="pictures" name="pictures[]" multiple>
                                                    <small class="form-text text-muted">Max upload size: 2MB. Supported
                                                        formats: JPG, PNG.</small>
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
@endsection
