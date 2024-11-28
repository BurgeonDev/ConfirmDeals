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

    {{-- <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Ads</h3>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="javascript:void(0)">

                                            {{ $category->name }}
                                            <span>{{ $category->ads->count() }}</span>
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
                                            <h3 class="title">Showing 1-12 of 21 ads found</h3>
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
                                    <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                        aria-labelledby="nav-grid-tab">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <!-- Start Single Item -->
                                                <div class="single-item-grid">
                                                    <div class="image">
                                                        <a href="item-details.html"><img
                                                                src="frontend/assets/images/items-tab/item-1.jpg"
                                                                alt="#"></a>
                                                        <i class=" cross-badge lni lni-bolt"></i>
                                                        <span class="flat-badge sale">Sale</span>
                                                    </div>
                                                    <div class="content">
                                                        <a href="javascript:void(0)" class="tag">Mobile</a>
                                                        <h3 class="title">
                                                            <a href="item-details.html">Apple Iphone X</a>
                                                        </h3>
                                                        <p class="location"><a href="javascript:void(0)"><i
                                                                    class="lni lni-map-marker">
                                                                </i>Boston</a></p>
                                                        <ul class="info">
                                                            <li class="price">$890.00</li>
                                                            <li class="like"><a href="javascript:void(0)"><i
                                                                        class="lni lni-heart"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <!-- End Single Item -->
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <!-- Start Single Item -->
                                                <div class="single-item-grid">
                                                    <div class="image">
                                                        <a href="item-details.html"><img
                                                                src="frontend/assets/images/items-tab/item-2.jpg"
                                                                alt="#"></a>
                                                        <i class=" cross-badge lni lni-bolt"></i>
                                                        <span class="flat-badge sale">Sale</span>
                                                    </div>
                                                    <div class="content">
                                                        <a href="javascript:void(0)" class="tag">Others</a>
                                                        <h3 class="title">
                                                            <a href="item-details.html">Travel Kit</a>
                                                        </h3>
                                                        <p class="location"><a href="javascript:void(0)"><i
                                                                    class="lni lni-map-marker">
                                                                </i>San Francisco</a></p>
                                                        <ul class="info">
                                                            <li class="price">$580.00</li>
                                                            <li class="like"><a href="javascript:void(0)"><i
                                                                        class="lni lni-heart"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- End Single Item -->
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                <div class="pagination left">
                                                    <ul class="pagination-list">
                                                        <li><a href="javascript:void(0)">1</a></li>
                                                        <li class="active"><a href="javascript:void(0)">2</a></li>
                                                        <li><a href="javascript:void(0)">3</a></li>
                                                        <li><a href="javascript:void(0)">4</a></li>
                                                        <li><a href="javascript:void(0)"><i
                                                                    class="lni lni-chevron-right"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                        aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <!-- Start Single Item -->
                                                <div class="single-item-grid">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-5 col-md-7 col-12">
                                                            <div class="image">
                                                                <a href="item-details.html"><img
                                                                        src="frontend/assets/images/items-tab/item-2.jpg"
                                                                        alt="#"></a>
                                                                <i class=" cross-badge lni lni-bolt"></i>
                                                                <span class="flat-badge sale">Sale</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7 col-md-5 col-12">
                                                            <div class="content">
                                                                <a href="javascript:void(0)" class="tag">Others</a>
                                                                <h3 class="title">
                                                                    <a href="item-details.html">Travel Kit</a>
                                                                </h3>
                                                                <p class="location"><a href="javascript:void(0)"><i
                                                                            class="lni lni-map-marker">
                                                                        </i>San Francisco</a></p>
                                                                <ul class="info">
                                                                    <li class="price">$580.00</li>
                                                                    <li class="like"><a href="javascript:void(0)"><i
                                                                                class="lni lni-heart"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Item -->
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <!-- Start Single Item -->
                                                <div class="single-item-grid">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-5 col-md-7 col-12">
                                                            <div class="image">
                                                                <a href="item-details.html"><img
                                                                        src="frontend/assets/images/items-tab/item-3.jpg"
                                                                        alt="#"></a>
                                                                <i class=" cross-badge lni lni-bolt"></i>
                                                                <span class="flat-badge sale">Sale</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7 col-md-5 col-12">
                                                            <div class="content">
                                                                <a href="javascript:void(0)" class="tag">Electronic</a>
                                                                <h3 class="title">
                                                                    <a href="item-details.html">Nikon DSLR Camera</a>
                                                                </h3>
                                                                <p class="location"><a href="javascript:void(0)"><i
                                                                            class="lni lni-map-marker">
                                                                        </i>Alaska, USA</a></p>
                                                                <ul class="info">
                                                                    <li class="price">$560.00</li>
                                                                    <li class="like"><a href="javascript:void(0)"><i
                                                                                class="lni lni-heart"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Item -->
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                <div class="pagination left">
                                                    <ul class="pagination-list">
                                                        <li><a href="javascript:void(0)">1</a></li>
                                                        <li class="active"><a href="javascript:void(0)">2</a></li>
                                                        <li><a href="javascript:void(0)">3</a></li>
                                                        <li><a href="javascript:void(0)">4</a></li>
                                                        <li><a href="javascript:void(0)"><i
                                                                    class="lni lni-chevron-right"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Ads</h3>
                            <form action="{{ route('ads.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Search Here..."
                                    value="{{ request('search') }}">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('ads.index', ['category' => $category->id]) }}"
                                            class="{{ request('category') == $category->id ? 'active' : '' }}">
                                            {{ $category->name }}
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
                                            {{-- <h3 class="title">
                                                Showing {{ $ads->firstItem() }}-{{ $ads->lastItem() }} of
                                                {{ $ads->total() }} ads found
                                                @if (request('category'))
                                                    in "{{ $categories->find(request('category'))->name }}"
                                                @endif
                                            </h3> --}}
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
                                    <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                        aria-labelledby="nav-grid-tab">
                                        <div class="row">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <!-- Start Single Item -->
                                                    <div class="single-item-grid">
                                                        <div class="image">
                                                            <a href="{{ route('ads.show', $ad->id) }}"><img
                                                                    src="{{ $ad->image_url }}" alt="#"></a>
                                                            @if ($ad->is_featured)
                                                                <i class="cross-badge lni lni-bolt"></i>
                                                            @endif
                                                            @if ($ad->status === 'sale')
                                                                <span class="flat-badge sale">Sale</span>
                                                            @endif
                                                        </div>
                                                        <div class="content">
                                                            <a href="javascript:void(0)"
                                                                class="tag">{{ $ad->category->name }}</a>
                                                            <h3 class="title">
                                                                <a
                                                                    href="{{ route('ads.show', $ad->id) }}">{{ $ad->title }}</a>
                                                            </h3>
                                                            <p class="location"><a href="javascript:void(0)"><i
                                                                        class="lni lni-map-marker"></i>{{ $ad->location }}</a>
                                                            </p>
                                                            <ul class="info">
                                                                <li class="price">${{ number_format($ad->price, 2) }}</li>
                                                                <li class="like"><a href="javascript:void(0)"><i
                                                                            class="lni lni-heart"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Item -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                {{-- <div class="pagination left">
                                                    {{ $ads->links() }}
                                                </div> --}}
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                        aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            @foreach ($ads as $ad)
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <!-- Start Single Item -->
                                                    <div class="single-item-grid">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-5 col-md-7 col-12">
                                                                <div class="image">
                                                                    <a href="{{ route('ads.show', $ad->id) }}"><img
                                                                            src="{{ $ad->image_url }}" alt="#"></a>
                                                                    @if ($ad->is_featured)
                                                                        <i class="cross-badge lni lni-bolt"></i>
                                                                    @endif
                                                                    @if ($ad->status === 'sale')
                                                                        <span class="flat-badge sale">Sale</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7 col-md-5 col-12">
                                                                <div class="content">
                                                                    <a href="javascript:void(0)"
                                                                        class="tag">{{ $ad->category->name }}</a>
                                                                    <h3 class="title">
                                                                        <a
                                                                            href="{{ route('ads.show', $ad->id) }}">{{ $ad->title }}</a>
                                                                    </h3>
                                                                    <p class="location"><a href="javascript:void(0)"><i
                                                                                class="lni lni-map-marker"></i>{{ $ad->location }}</a>
                                                                    </p>
                                                                    <ul class="info">
                                                                        <li class="price">
                                                                            ${{ number_format($ad->price, 2) }}</li>
                                                                        <li class="like"><a href="javascript:void(0)"><i
                                                                                    class="lni lni-heart"></i></a>
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
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                                {{-- <div class="pagination left">
                                                    {{ $ads->links() }}
                                                </div> --}}
                                                <!--/ End Pagination -->
                                            </div>
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
