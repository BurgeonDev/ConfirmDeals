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
                            <h3 class="block-title">My Featured Ads</h3>

                            <div class="my-items">
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <p>@lang('messages.ad_title')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>@lang('messages.category')</p>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-12">
                                            <p>@lang('messages.type')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>@lang('messages.status')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12 align-right">
                                            <p>@lang('messages.action')</p>
                                        </div>
                                    </div>
                                </div>

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
                                                @if ($ad->featured_until)
                                                    @php
                                                        $remainingTime = \Carbon\Carbon::parse(
                                                            $ad->featured_until,
                                                        )->diff(now());
                                                        $hours = $remainingTime->h;
                                                        $minutes = $remainingTime->i;
                                                    @endphp
                                                    <p>{{ $hours }} hours and {{ $minutes }} minutes left</p>
                                                @else
                                                    <p>No time left</p>
                                                @endif
                                            </div>






                                            <div class="col-lg-2 col-md-2 col-12 align-right">
                                                <ul
                                                    class="action-btn list-unstyled d-flex justify-content-start align-items-center">
                                                    <!-- Edit Button -->
                                                    <li>
                                                        <button type="button" class="btn btn-outline-primary btn-sm me-2"
                                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                                            <i class="lni lni-pencil"></i> Edit
                                                        </button>
                                                    </li>

                                                    <!-- Un-feature Button -->
                                                    <li>
                                                        <form action="{{ route('ad.unfeature', $ad->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                                title="Un-feature this ad">
                                                                <i class="lni lni-trash"></i> Unfeature
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>

                                                <!-- Modal for Editing -->

                                                <div class="modal fade" id="editModal" tabindex="-1"
                                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Update Featured
                                                                    Ad</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('ad.updateFeature', $ad->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <div class="mb-2 row align-items-center">
                                                                        <div class="col-auto">
                                                                            <strong>Days left to be Unfeatured:</strong>
                                                                        </div>
                                                                        <div class="col">
                                                                            <p class="mb-0">

                                                                                @php
                                                                                    $remainingTime = \Carbon\Carbon::parse(
                                                                                        $ad->featured_until,
                                                                                    )->diff(now());
                                                                                    $hours = $remainingTime->h;
                                                                                    $minutes = $remainingTime->i;
                                                                                @endphp
                                                                                {{ $hours }} hours and
                                                                                {{ $minutes }} minutes left

                                                                            </p>

                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3" style="text-align: left">
                                                                        <label for="featured_days" class="form-label">Update
                                                                            Number
                                                                            of days to feature this ad:</label>

                                                                        <input type="number" id="featured_days"
                                                                            class="form-control" name="featured_days"
                                                                            min="1" value="" required>



                                                                        <small id="coinMessage" class="text-muted"></small>
                                                                        <small id="errorMessage"
                                                                            class="text-danger"></small>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        Featured Ad</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                @empty
                                    <p>No featured ads available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const featuredDaysInput = document.getElementById('featured_days');
            const coinMessage = document.getElementById('coinMessage');
            const errorMessage = document.getElementById('errorMessage');

            const featuredAdRate = {{ $featuredAdRate }};
            const userCoins = {{ auth()->user()->coins }};
            let currentFeaturedDays = 0;

            @if (isset($ad))
                currentFeaturedDays =
                    {{ $ad->featured_until ? \Carbon\Carbon::parse($ad->featured_until)->diffInDays(now()) : 0 }};
            @endif

            featuredDaysInput.addEventListener('input', function() {
                const enteredDays = parseInt(featuredDaysInput.value) || 0;
                const requiredCoins = enteredDays * featuredAdRate;
                const coinBalance = userCoins - requiredCoins;

                if (coinBalance < 0) {
                    errorMessage.textContent =
                        `Sorry, you don't have enough coins. You need ${Math.abs(coinBalance)} more coins.`;
                } else {
                    errorMessage.textContent = '';
                }

                if (enteredDays > currentFeaturedDays) {
                    coinMessage.textContent =
                        `Additional ${requiredCoins} coins will be deducted for ${enteredDays} days.`;
                } else if (enteredDays < currentFeaturedDays) {
                    coinMessage.textContent = `Reducing days will adjust the feature duration accordingly.`;
                } else {
                    coinMessage.textContent = '';
                }
            });
        });
    </script>

@endsection
