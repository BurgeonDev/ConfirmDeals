@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Favorite Ads</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Favorite Ads</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
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
                            <h3 class="block-title">My Favorite Ads</h3>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <!-- Start Item List Title -->
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <p>Ad Title</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Category</p>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-12">
                                            <p>Type</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Status</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12 align-right">
                                            <p>Action</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->

                                <!-- Start Single List -->
                                @forelse ($favorites as $favorite)
                                    @php $ad = $favorite->ad; @endphp
                                    <div class="single-item-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="item-image">
                                                    @if (!empty($ad->pictures) && is_array($ad->pictures))
                                                        <img src="{{ asset('storage/' . $ad->pictures[0]) }}"
                                                            alt="Ad Picture" class="img-thumbnail"
                                                            style="width: 75px; height: 75px;">
                                                    @else
                                                        <span>No Picture</span>
                                                    @endif

                                                    <div class="content">
                                                        <h3 class="title">
                                                            <a
                                                                href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                                        </h3>
                                                        <span class="price">{{ number_format($ad->price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ $ad->category->name }}</p>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-12">
                                                <p>{{ $ad->type }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ $ad->is_verified == 1 ? 'Verified' : 'Not Verified' }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12 align-right">
                                                <ul class="action-btn">
                                                    <li>
                                                        <form action="{{ route('favorites.toggle') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="ad_id"
                                                                value="{{ $ad->id }}">
                                                            <button type="submit"
                                                                style="border: none; background: none; color: {{ $ad->is_favorite ? 'blue' : 'red' }};">
                                                                <i
                                                                    class="{{ $ad->is_favorite ? 'lni lni-heart-filled' : 'lni lni-heart' }}"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No favorite ads available.</p>
                                @endforelse
                                <!-- End Single List -->
                            </div>

                            <!-- Pagination -->
                            <div style="justify-content: center" class="pagination center">
                                <ul class="pagination-list">
                                    @if ($favorites->onFirstPage())
                                        <li class="disabled">
                                            <a href="javascript:void(0)">
                                                <i class="lni lni-chevron-left"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $favorites->previousPageUrl() }}">
                                                <i class="lni lni-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach ($favorites->getUrlRange(1, $favorites->lastPage()) as $page => $url)
                                        <li class="{{ $favorites->currentPage() == $page ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($favorites->hasMorePages())
                                        <li>
                                            <a href="{{ $favorites->nextPageUrl() }}">
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
                            <!-- End Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
