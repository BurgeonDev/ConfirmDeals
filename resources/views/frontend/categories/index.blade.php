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
                        <!-- Search Widget -->
                        <div class="single-widget search">
                            <h3>Search Ads</h3>
                            <form id="searchForm" action="javascript:void(0)">
                                <input type="text" id="searchInput" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <div class="single-widget">
                            <h3>Filter by Location</h3>
                            <ul class="list">
                                <li>
                                    <a href="javascript:void(0)" class="location-filter" data-city="all"
                                        data-locality="all">
                                        All Locations
                                    </a>
                                </li>
                                @foreach ($cities as $city)
                                    <li class="city-item">
                                        <a href="javascript:void(0)" class="city-toggle" data-city="{{ $city->name }}">
                                            {{ $city->name }}
                                        </a>
                                        <ul class="list locality-list" style="display: none;">
                                            <li>
                                                <a href="javascript:void(0)" class="location-filter"
                                                    data-city="{{ $city->name }}" data-locality="all">
                                                    All {{ $city->name }}
                                                </a>
                                            </li>
                                            @foreach ($city->localities as $locality)
                                                <li>
                                                    <a href="javascript:void(0)" class="location-filter"
                                                        data-city="{{ $city->name }}"
                                                        data-locality="{{ $locality->name }}">
                                                        {{ $locality->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Category Widget -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                <li>
                                    <a href="javascript:void(0)" class="category-filter" data-category="all">
                                        All <span>{{ $ads->count() }}</span>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="javascript:void(0)" class="category-filter"
                                            data-category="{{ $category->id }}">
                                            {{ $category->name }}
                                            <span>{{ $category->ads->where('is_verified', 1)->count() }}</span>

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
                                                    <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-grid" type="button" role="tab"
                                                        aria-controls="nav-grid" aria-selected="true"><i
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
        document.addEventListener("DOMContentLoaded", () => {
            const adsContainer = document.getElementById("adsContainer");
            const adsCount = document.getElementById("adsCount");

            // Filter by Search
            const searchInput = document.getElementById("searchInput");
            searchInput.addEventListener("keyup", () => {
                const searchTerm = searchInput.value.toLowerCase();
                const ads = document.querySelectorAll(".ad-item");

                let visibleAds = 0;

                ads.forEach(ad => {
                    const title = ad.querySelector(".title a").textContent.toLowerCase();
                    if (title.includes(searchTerm)) {
                        ad.style.display = "block";
                        visibleAds++;
                    } else {
                        ad.style.display = "none";
                    }
                });

                adsCount.textContent = `Showing ${visibleAds} ads`;
            });
            // Toggle visibility of locality lists under each city
            document.querySelectorAll(".city-toggle").forEach(cityToggle => {
                cityToggle.addEventListener("click", () => {
                    const localityList = cityToggle.nextElementSibling;

                    if (localityList.style.display === "none") {
                        localityList.style.display = "block"; // Show localities
                    } else {
                        localityList.style.display = "none"; // Hide localities
                    }
                });
            });
            // Filter by Category
            document.querySelectorAll(".category-filter").forEach(categoryFilter => {
                categoryFilter.addEventListener("click", () => {
                    const category = categoryFilter.getAttribute("data-category");
                    const ads = document.querySelectorAll(".ad-item");

                    // Highlight active category
                    document.querySelectorAll(".category-filter").forEach(item => {
                        item.classList.remove("active");
                    });
                    categoryFilter.classList.add("active");

                    let visibleAds = 0;

                    ads.forEach(ad => {
                        if (category === "all" || ad.getAttribute("data-category") ===
                            category) {
                            ad.style.display = "block";
                            visibleAds++;
                        } else {
                            ad.style.display = "none";
                        }
                    });

                    adsCount.textContent = `Showing ${visibleAds} ads`;
                });
            });
            // Filter by Location
            document.querySelectorAll(".location-filter").forEach(locationFilter => {
                locationFilter.addEventListener("click", () => {
                    const selectedCity = locationFilter.getAttribute("data-city");
                    const selectedLocality = locationFilter.getAttribute("data-locality");
                    const ads = document.querySelectorAll(".ad-item");

                    // Highlight active location
                    document.querySelectorAll(".location-filter").forEach(item => {
                        item.classList.remove("active");
                    });
                    locationFilter.classList.add("active");

                    let visibleAds = 0;

                    ads.forEach(ad => {
                        const adCity = ad.getAttribute("data-city");
                        const adLocality = ad.getAttribute("data-locality");

                        if (
                            (selectedCity === "all" || adCity === selectedCity) &&
                            (selectedLocality === "all" || adLocality === selectedLocality)
                        ) {
                            ad.style.display = "block";
                            visibleAds++;
                        } else {
                            ad.style.display = "none";
                        }
                    });
                    adsCount.textContent = `Showing ${visibleAds} ads`;
                });
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get("keyword");
            const selectedCategory = urlParams.get("category");
            const selectedCity = urlParams.get("city");
            const selectedLocality = urlParams.get("locality");

            // Set the keyword input field if present
            if (keyword) {
                document.getElementById("searchInput").value = decodeURIComponent(keyword);
            }

            // Set the active state for category filters
            document.querySelectorAll(".category-filter").forEach((element) => {
                if (element.getAttribute("data-category") === selectedCategory) {
                    element.classList.add("active"); // Add a class for styling
                }
            });

            // Set the active state for location filters
            document.querySelectorAll(".location-filter").forEach((element) => {
                const city = element.getAttribute("data-city");
                const locality = element.getAttribute("data-locality");

                if (
                    (city === selectedCity || city === "all") &&
                    (locality === selectedLocality || locality === "all")
                ) {
                    element.classList.add("active"); // Add a class for styling
                }
            });
        });
    </script>
    <style>
        .active {
            font-weight: bold;
            color: #007bff;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Check for the keyword in the URL query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const keyword = urlParams.get("keyword");
            // If a keyword is found, set the value of the search input field
            if (keyword) {
                document.getElementById("searchInput").value = decodeURIComponent(keyword);
            }
        });
    </script>
@endsection
