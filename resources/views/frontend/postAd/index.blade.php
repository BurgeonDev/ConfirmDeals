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
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="mt-0 dashboard-block">
                            <h3 class="block-title">My Ads</h3>

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
                                @forelse ($ads as $ad)
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
                                                <p>
                                                    {{ $ad->is_verified == 1 ? 'Verified' : 'Not Verified' }}
                                                </p>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-12 align-right">
                                                <ul class="action-btn">
                                                    <li>
                                                        <a href="{{ route('ad.edit', $ad->id) }}">
                                                            <i class="lni lni-pencil" style="color: blue"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('ad.show', $ad->id) }}">
                                                            <i class="lni lni-eye" style="color: green"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a>
                                                            <form action="{{ route('ad.destroy', $ad->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this ad?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="border: none; background: none; color:red">
                                                                    <i class="lni lni-trash"></i>
                                                                </button>
                                                            </form>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No ads available.</p>
                                @endforelse
                                <!-- End Single List -->
                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
