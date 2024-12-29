@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Category</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>category</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">

                        <!-- Search -->

                        <div class="single-widget search">
                            <h3>Search Ads</h3>
                            <form method="GET" action="{{ route('categoriess') }}">
                                <input type="text" name="search" placeholder="Search Here..."
                                    value="{{ request('search') }}">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- Location Filter -->
                        <div class="single-widget">
                            <h3>Filter by Location</h3>
                            <form method="GET" action="{{ route('categoriess') }}" id="location-filter-form">
                                <!-- Hidden Inputs for Filters -->
                                <input type="hidden" name="city" id="city-input" value="{{ request('city') }}">
                                <input type="hidden" name="locality" id="locality-input" value="{{ request('locality') }}">

                                <!-- City Filter -->
                                <ul class="list city-list">
                                    <!-- All Cities -->
                                    <li>
                                        <a href="javascript:void(0)"
                                            class="city-filter {{ request('city') == '' ? 'active' : '' }}"
                                            onclick="submitFilter('all', 'all')"
                                            style="text-decoration: none; color: {{ request('city') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('city') == '' ? 'bold' : 'normal' }};">
                                            All Locations
                                        </a>
                                    </li>

                                    <!-- Individual Cities -->
                                    @foreach ($cities as $city)
                                        <li class="city-item">
                                            <a href="javascript:void(0)"
                                                class="city-filter {{ request('city') == $city->name && request('locality') == '' ? 'active' : '' }}"
                                                onclick="toggleLocalityList('{{ $city->name }}')"
                                                style="text-decoration: none; color: {{ request('city') == $city->name && request('locality') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('city') == $city->name && request('locality') == '' ? 'bold' : 'normal' }};">
                                                {{ $city->name }}
                                            </a>
                                            <!-- Localities under each city -->
                                            <ul class="list locality-list" id="locality-{{ $city->name }}"
                                                style="display: {{ request('city') == $city->name ? 'block' : 'none' }};">
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="locality-filter {{ request('city') == $city->name && request('locality') == '' ? 'active' : '' }}"
                                                        onclick="submitFilter('{{ $city->name }}', 'all')"
                                                        style="text-decoration: none; color: {{ request('city') == $city->name && request('locality') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('city') == $city->name && request('locality') == '' ? 'bold' : 'normal' }};">
                                                        All {{ $city->name }}
                                                    </a>
                                                </li>
                                                @foreach ($city->localities as $locality)
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="locality-filter {{ request('locality') == $locality->name ? 'active' : '' }}"
                                                            onclick="submitFilter('{{ $city->name }}', '{{ $locality->name }}')"
                                                            style="text-decoration: none; color: {{ request('locality') == $locality->name ? '#6610f2' : '#000' }}; font-weight: {{ request('locality') == $locality->name ? 'bold' : 'normal' }};">
                                                            {{ $locality->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </form>
                        </div>

                        <!-- Category Filter -->

                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <form id="categoryForm" method="GET" action="{{ route('categoriess') }}">
                                <input type="hidden" name="category" id="categoryInput" value="{{ request('category') }}">
                            </form>
                            <ul class="list">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="category-filter {{ request('category') == '' ? 'active' : '' }}"
                                        data-category=""
                                        style="text-decoration: none; color: {{ request('category') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('category') == '' ? 'bold' : 'normal' }};">
                                        All Categories
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="javascript:void(0)"
                                            class="category-filter {{ request('category') == $category->id ? 'active' : '' }}"
                                            data-category="{{ $category->id }}"
                                            style="text-decoration: none; color: {{ request('category') == $category->id ? '#6610f2' : '#000' }}; font-weight: {{ request('category') == $category->id ? 'bold' : 'normal' }};">
                                            {{ $category->name }}
                                            <span>{{ $category->ads->where('is_verified', 1)->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-widget search">
                            <h3>Price Range</h3>
                            <form method="GET" action="{{ route('categoriess') }}" id="price-range-form">
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <!-- Minimum Price Input -->
                                    <input type="number" name="price_min" id="price-min-input" min="0"
                                        value="{{ request('price_min') }}" placeholder="Min Price"
                                        style="width: 100px; padding: 5px; text-align: center;"
                                        onchange="updatePriceRange()">
                                    <span>to</span>

                                    <!-- Maximum Price Input -->
                                    <input type="number" name="price_max" id="price-max-input" min="0"
                                        value="{{ request('price_max') }}" placeholder="Max Price"
                                        style="width: 100px; padding: 5px; text-align: center;"
                                        onchange="updatePriceRange()">
                                </div>
                            </form>
                        </div>

                        <script>
                            function updatePriceRange() {
                                var minValue = document.getElementById('price-min-input').value;
                                var maxValue = document.getElementById('price-max-input').value;

                                // Ensure the values are within the defined range
                                minValue = Math.max(minValue, 0); // Prevent going below 0
                                maxValue = Math.max(maxValue, 0); // Prevent going below 0

                                // Update the form values dynamically
                                document.getElementById('price-min-input').value = minValue;
                                document.getElementById('price-max-input').value = maxValue;

                                // Automatically submit the form to apply the filter
                                document.getElementById('price-range-form').submit();
                            }
                        </script>






                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="category-grid-list">
                        <div class="row">
                            <div class="col-12">
                                <div class="category-grid-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <h3 class="title" id="adsCount">Showing
                                                {{ $ads->where('is_verified', 1)->count() }} ads</h3>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link active" id="nav-grid-tab"
                                                        data-bs-toggle="tab" data-bs-target="#nav-grid" type="button"
                                                        role="tab" aria-controls="nav-grid" aria-selected="true"><i
                                                            class="lni lni-grid-alt"></i></button>
                                                    <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-list" type="button" role="tab"
                                                        aria-controls="nav-list" aria-selected="false"><i
                                                            class="lni lni-list"></i></button>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                                        aria-labelledby="nav-grid-tab">
                                        <div class="row" id="adsContainer">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-4 col-md-6 col-12 ad-item"
                                                    data-city="{{ $ad->city?->name ?? 'N/A' }}"
                                                    data-locality="{{ $ad->locality?->name ?? 'N/A' }}"
                                                    data-category="{{ $ad->category_id }}">
                                                    <div class="single-item-grid">
                                                        <div class="image">
                                                            <a href="{{ route('ad.show', $ad->id) }}">
                                                                <img style="width: 100%; height: 250px; object-fit: cover;"
                                                                    src="{{ asset('storage/' . $ad->pictures[0]) }}"
                                                                    alt="{{ $ad->title }}">
                                                            </a>
                                                            <span class="flat-badge sale">{{ ucfirst($ad->type) }}</span>
                                                        </div>
                                                        <div class="content">
                                                            <a href="javascript:void(0)"
                                                                class="tag">{{ $ad->category?->name ?? 'N/A' }}</a>
                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                                            </h3>
                                                            <p class="location"><a><i class="lni lni-map-marker"></i>
                                                                    {{ $ad->city?->name ?? 'N/A' }},
                                                                    {{ $ad->locality?->name ?? 'N/A' }}</a></p>
                                                            <ul class="info">
                                                                <li class="price">Pkr {{ number_format($ad->price, 2) }}
                                                                </li>
                                                                <li class="like">
                                                                    <form action="{{ route('favorites.toggle') }}"
                                                                        method="POST" class="favorite-form">
                                                                        @csrf
                                                                        <input type="hidden" name="ad_id"
                                                                            value="{{ $ad->id }}">
                                                                        <button type="submit" class="favorite-button">
                                                                            <i
                                                                                class="lni lni-heart {{ $ad->isFavoritedBy(auth()->user()) ? 'active' : '' }}"></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Custom Pagination -->
                                        <div style="justify-content: center" class="pagination center">
                                            <ul class="pagination-list">
                                                @if ($ads->onFirstPage())
                                                    <li class="disabled">
                                                        <a href="javascript:void(0)">
                                                            <i class="lni lni-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $ads->previousPageUrl() }}">
                                                            <i class="lni lni-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @endif

                                                @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                                    <li class="{{ $ads->currentPage() == $page ? 'active' : '' }}">
                                                        <a href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endforeach

                                                @if ($ads->hasMorePages())
                                                    <li>
                                                        <a href="{{ $ads->nextPageUrl() }}">
                                                            <i class="lni lni-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="disabled">
                                                        <a href="javascript:void(0)">
                                                            <i class="lni lni-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                        aria-labelledby="nav-list-tab">
                                        <div class="row" id="adsContainer">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-12 col-md-12 col-12 ad-item"
                                                    data-city="{{ $ad->city?->name ?? 'N/A' }}"
                                                    data-locality="{{ $ad->locality?->name ?? 'N/A' }}"
                                                    data-category="{{ $ad->category_id }}">
                                                    <!-- Start Single Item -->
                                                    <div class="single-item-grid">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-5 col-md-7 col-12">
                                                                <div class="image">
                                                                    <a href="{{ route('ad.show', $ad->id) }}">
                                                                        <img style="width: 100%; height: 250px; object-fit: cover;"
                                                                            src="{{ asset('storage/' . $ad->pictures[0]) }}"
                                                                            alt="{{ $ad->title }}">
                                                                    </a>
                                                                    <span
                                                                        class="flat-badge sale">{{ ucfirst($ad->type) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7 col-md-5 col-12">
                                                                <div class="content">
                                                                    <a href="javascript:void(0)"
                                                                        class="tag">{{ $ad->category?->name ?? 'N/A' }}</a>
                                                                    <h3 class="title">
                                                                        <a
                                                                            href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                                                    </h3>
                                                                    <p class="location"><a><i
                                                                                class="lni lni-map-marker"></i>
                                                                            {{ $ad->city?->name ?? 'N/A' }},
                                                                            {{ $ad->locality?->name ?? 'N/A' }}</a></p>
                                                                    <ul class="info">
                                                                        <li class="price">
                                                                            Pkr {{ number_format($ad->price, 2) }}
                                                                        </li>
                                                                        <li class="like">
                                                                            <form action="{{ route('favorites.toggle') }}"
                                                                                method="POST" class="favorite-form">
                                                                                @csrf
                                                                                <input type="hidden" name="ad_id"
                                                                                    value="{{ $ad->id }}">
                                                                                <button type="submit"
                                                                                    class="favorite-button">
                                                                                    <i
                                                                                        class="lni lni-heart {{ $ad->isFavoritedBy(auth()->user()) ? 'active' : '' }}"></i>
                                                                                </button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Item -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Pagination -->
                                        <div style="justify-content: center" class="pagination center">
                                            <ul class="pagination-list">
                                                @if ($ads->onFirstPage())
                                                    <li class="disabled">
                                                        <a href="javascript:void(0)">
                                                            <i class="lni lni-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $ads->previousPageUrl() }}">
                                                            <i class="lni lni-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @endif

                                                @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                                    <li class="{{ $ads->currentPage() == $page ? 'active' : '' }}">
                                                        <a href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endforeach

                                                @if ($ads->hasMorePages())
                                                    <li>
                                                        <a href="{{ $ads->nextPageUrl() }}">
                                                            <i class="lni lni-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li class="disabled">
                                                        <a href="javascript:void(0)">
                                                            <i class="lni lni-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.category-filter').forEach(item => {
            item.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                document.getElementById('categoryInput').value = category;
                document.getElementById('categoryForm').submit();
            });
        });
    </script>
    <script>
        // Function to show/hide localities under a city
        function toggleLocalityList(cityName) {
            // Hide all locality lists
            document.querySelectorAll('.locality-list').forEach(function(list) {
                list.style.display = 'none';
            });

            // Show the clicked city's locality list
            const localityList = document.getElementById('locality-' + cityName);
            if (localityList) {
                localityList.style.display = 'block';
            }

            // Set the city input and reset locality input, then submit
            document.getElementById('city-input').value = cityName === 'all' ? '' : cityName;
            document.getElementById('locality-input').value = '';
            document.getElementById('location-filter-form').submit();
        }

        // Function to submit filter directly
        function submitFilter(city, locality) {
            document.getElementById('city-input').value = city === 'all' ? '' : city;
            document.getElementById('locality-input').value = locality === 'all' ? '' : locality;
            document.getElementById('location-filter-form').submit();
        }
    </script>
@endsection
