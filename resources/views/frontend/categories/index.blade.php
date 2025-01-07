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
                                            <span>{{ $category->ads->where('status', 'verified')->count() }}</span>
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
                        <!-- Type Filter -->
                        <div class="single-widget type-filter">
                            <h3>Type</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="all" id="typeAll"
                                    onchange="document.getElementById('filter-form').submit();"
                                    {{ in_array('all', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="typeAll">
                                    All
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="product"
                                    id="typeProduct" onchange="document.getElementById('filter-form').submit();"
                                    {{ in_array('product', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="typeProduct">
                                    Product
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="service"
                                    id="typeService" onchange="document.getElementById('filter-form').submit();"
                                    {{ in_array('service', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="typeService">
                                    Service
                                </label>
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
                                                {{ $ads->where('status', 'verified')->count() }} ads</h3>

                                        </div>
                                        {{-- <div class="col-lg-6 col-md-6 col-12">
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
                                        </div> --}}
                                        <div
                                            class="col-lg-6 col-md-6 col-12 d-flex justify-content-end align-items-center">
                                            <select id="sortDropdown" class="form-select"
                                                style="width: auto; margin-right: 10px;">
                                                <option value="">Sort By</option>
                                                <option value="lowToHigh">Price: Low to High</option>
                                                <option value="highToLow">Price: High to Low</option>
                                            </select>
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
                                    <!-- Grid view -->
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
                                                                    src="{{ !empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0 ? asset('storage/' . $ad->pictures[0]) : asset('assets/images/default-image.jpg') }}"
                                                                    alt="{{ $ad->title }}">
                                                            </a>

                                                            @if ($ad->is_featured)
                                                                <i class="cross-badge lni lni-bolt"></i>
                                                            @endif

                                                            @if ($ad->is_featured)
                                                                <span class="flat-badge sale">
                                                                    Featured
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="content">
                                                            <div
                                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                                <a href="javascript:void(0)"
                                                                    class="tag">{{ $ad->category?->name ?? 'N/A' }}</a>
                                                                <span class="flat-badge"
                                                                    style="color: {{ $ad->type === 'service' ? 'green' : 'red' }};">
                                                                    {{ ucfirst($ad->type) }}
                                                                </span>

                                                            </div>
                                                            <h3
                                                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 1.2rem; width: 100%;">
                                                                <a href="{{ route('ad.show', $ad->id) }}"
                                                                    style="text-decoration: none; color: inherit;">
                                                                    {{ $ad->title }}
                                                                </a>
                                                            </h3>
                                                            <div class="user-rating">
                                                                <div class="rating">
                                                                    @php
                                                                        $averageRating =
                                                                            $ad->user->feedbacks_avg_rating ?? 0; // Default to 0 if no rating
                                                                    @endphp

                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($averageRating >= $i)
                                                                            <i class="fa fa-star text-warning"></i>
                                                                        @elseif ($averageRating >= $i - 0.5)
                                                                            <i
                                                                                class="fa fa-star-half-alt text-warning"></i>
                                                                        @else
                                                                            <i class="fa fa-star text-muted"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <span>({{ number_format($averageRating, 1) }})</span>
                                                                </div>
                                                            </div>
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
                                        <div class="pagination center" style="justify-content: center;">
                                            {!! $remainingAds->links('vendor.pagination.custom-pagination') !!}
                                        </div>
                                    </div>
                                    <!-- List View-->
                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                        aria-labelledby="nav-list-tab">
                                        <div class="row" id="adsContaine">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-12 col-md-12 col-12 ad-ite"
                                                    data-city="{{ $ad->city?->name ?? 'N/A' }}"
                                                    data-locality="{{ $ad->locality?->name ?? 'N/A' }}"
                                                    data-category="{{ $ad->category_id }}">
                                                    <div class="single-item-grid">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-5 col-md-7 col-12">
                                                                <div class="image">
                                                                    <a href="{{ route('ad.show', $ad->id) }}">
                                                                        <img style="width: 100%; height: 250px; object-fit: cover;"
                                                                            src="{{ !empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0 ? asset('storage/' . $ad->pictures[0]) : asset('assets/images/default-image.jpg') }}"
                                                                            alt="{{ $ad->title }}">
                                                                    </a>
                                                                    @if ($ad->is_featured)
                                                                        <i class="cross-badge lni lni-bolt"></i>
                                                                    @endif
                                                                    @if ($ad->is_featured)
                                                                        <span class="flat-badge sale">
                                                                            Featured
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7 col-md-5 col-12">
                                                                <div class="content">
                                                                    <div
                                                                        style="display: flex; justify-content: space-between; align-items: center;">
                                                                        <a href="javascript:void(0)"
                                                                            class="tag">{{ $ad->category?->name ?? 'N/A' }}</a>
                                                                        <span class="flat-badge"
                                                                            style="color: {{ $ad->type === 'service' ? 'green' : 'red' }};">
                                                                            {{ ucfirst($ad->type) }}
                                                                        </span>

                                                                    </div>

                                                                    <h3 class="title">
                                                                        <a
                                                                            href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                                                    </h3>
                                                                    <div class="user-rating">
                                                                        <div class="rating">
                                                                            @php
                                                                                $averageRating =
                                                                                    $ad->user->feedbacks_avg_rating ??
                                                                                    0; // Default to 0 if no rating
                                                                            @endphp

                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($averageRating >= $i)
                                                                                    <i class="fa fa-star text-warning"></i>
                                                                                @elseif ($averageRating >= $i - 0.5)
                                                                                    <i
                                                                                        class="fa fa-star-half-alt text-warning"></i>
                                                                                @else
                                                                                    <i class="fa fa-star text-muted"></i>
                                                                                @endif
                                                                            @endfor
                                                                            <span>({{ number_format($averageRating, 1) }})</span>
                                                                        </div>
                                                                    </div>
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
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination center" style="justify-content: center;">
                                            {!! $remainingAds->links('vendor.pagination.custom-pagination') !!}
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
@endsection
