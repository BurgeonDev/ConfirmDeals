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
                        <!-- Search Filter -->
                        <div class="single-widget search">
                            <h3>Search Ads</h3>
                            <form method="GET" action="{{ route('categoriess') }}" id="filter-form">
                                <input type="text" name="search" placeholder="Search Here..."
                                    value="{{ request('search') }}">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </div>

                        <!-- Location Filter -->
                        <div class="single-widget">
                            <h3>Filter by Location</h3>
                            <input type="hidden" name="city" id="city-input" value="{{ request('city') }}">
                            <input type="hidden" name="locality" id="locality-input" value="{{ request('locality') }}">

                            <ul class="list city-list">
                                <li>
                                    <a href="javascript:void(0)"
                                        class="city-filter {{ request('city') == '' ? 'active' : '' }}"
                                        onclick="submitFilter('all', 'all')"
                                        style="text-decoration: none; color: {{ request('city') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('city') == '' ? 'bold' : 'normal' }};">
                                        All Locations
                                    </a>
                                </li>
                                @foreach ($cities as $city)
                                    <li class="city-item">
                                        <a href="javascript:void(0)"
                                            class="city-filter {{ request('city') == $city->name ? 'active' : '' }}"
                                            onclick="toggleLocalityList('{{ $city->name }}')"
                                            style="text-decoration: none; color: {{ request('city') == $city->name && request('locality') == '' ? '#6610f2' : '#000' }}; font-weight: {{ request('city') == $city->name && request('locality') == '' ? 'bold' : 'normal' }};">
                                            {{ $city->name }}
                                        </a>
                                        <ul class="list locality-list" id="locality-{{ $city->name }}"
                                            style="display: {{ request('city') == $city->name ? 'block' : 'none' }};">
                                            @foreach ($city->localities as $locality)
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="locality-filter {{ request('locality') == $locality->name ? 'active' : '' }}"
                                                        onclick="submitFilter('{{ $city->name }}', '{{ $locality->name }}')"
                                                        style="text-decoration: none; color: {{ request('locality') == $locality->name ? '#6610f2' : '#000' }}; font-weight: {{ request('locality') == $locality->name ? 'bold' : 'normal' }}; padding-left:10px;">
                                                        {{ $locality->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Category Filter -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <input type="hidden" name="category" id="categoryInput" value="{{ request('category') }}">
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
                                            data-category="{{ $category->id }}"style="text-decoration: none; color: {{ request('category') == $category->id ? '#6610f2' : '#000' }}; font-weight: {{ request('category') == $category->id ? 'bold' : 'normal' }};">
                                            {{ $category->name }}
                                            <span>{{ $category->ads->where('is_verified', 1)->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="single-widget search">
                            <h3>Price Range</h3>
                            <div style="display: flex; gap: 10px; align-items: center;">

                                <input type="number" name="price_min" id="price-min-input" min="0"
                                    value="{{ request('price_min') }}" placeholder="Min" onchange="updatePriceRange()">
                                <span>to</span>
                                <input type="number" name="price_max" id="price-max-input" min="0"
                                    value="{{ request('price_max') }}" placeholder="Max" onchange="updatePriceRange()">
                            </div>
                        </div>
                        {{-- <button type="submit" style="display:none;">Submit</button> --}}
                        </form>
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
                                        <div class="row" id="adsContaine">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-4 col-md-6 col-12 ad-ite"
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
                                                            @if ($ad->is_featured)
                                                                <i class="cross-badge lni lni-bolt"></i>
                                                            @endif
                                                            <span class="flat-badge sale">{{ ucfirst($ad->type) }}</span>
                                                        </div>
                                                        <div class="content">
                                                            <a href="javascript:void(0)"
                                                                class="tag">{{ $ad->category?->name ?? 'N/A' }}</a>
                                                            <h3
                                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 1.2rem; width: 100%;">
                                                                <a href="{{ route('ad.show', $ad->id) }}"
                                                                    style="text-decoration: none; color: inherit;">
                                                                    {{ $ad->title }}
                                                                </a>
                                                            </h3>

                                                            <p class="location"><a><i class="lni lni-map-marker"></i>
                                                                    {{ $ad->city?->name ?? 'N/A' }},
                                                                    {{ $ad->locality?->name ?? 'N/A' }}</a></p>
                                                            <ul class="info">
                                                                <li class="price">PKR {{ number_format($ad->price, 0) }}
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
                                        <div class="row" id="adsContaine">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-12 col-md-12 col-12 ad-ite"
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
                                                                    @if ($ad->is_featured)
                                                                        <i class="cross-badge lni lni-bolt"></i>
                                                                    @endif
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
                                                                            PKR {{ number_format($ad->price, 0) }}
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
        // Update filters dynamically
        document.querySelectorAll('.category-filter').forEach(item => {
            item.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                document.getElementById('categoryInput').value = category;
                document.getElementById('filter-form').submit();
            });
        });

        function updatePriceRange() {
            document.getElementById('filter-form').submit();
        }

        // Toggle locality list based on selected city
        function toggleLocalityList(cityName) {
            document.querySelectorAll('.locality-list').forEach(function(list) {
                list.style.display = 'none';
            });
            const localityList = document.getElementById('locality-' + cityName);
            localityList.style.display = 'block';
            document.getElementById('city-input').value = cityName === 'all' ? '' : cityName;
            document.getElementById('locality-input').value = '';
            document.getElementById('filter-form').submit();
        }

        function submitFilter(city, locality) {
            document.getElementById('city-input').value = city === 'all' ? '' : city;
            document.getElementById('locality-input').value = locality === 'all' ? '' : locality;
            document.getElementById('filter-form').submit();
        }
    </script>
@endsection
