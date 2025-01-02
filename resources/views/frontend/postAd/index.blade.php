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
                            <h3 class="block-title">My Ads</h3>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <!-- Start Item List Title -->
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 col-md-3 col-12">
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
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Featured</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12 align-right">
                                            <p>@lang('messages.action')</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- End List Title -->

                                <!-- Start Single List -->
                                @forelse ($ads as $ad)
                                    <div class="single-item-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3 col-md-3 col-12">
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
                                                <p>{{ $ad->status }}</p>
                                            </div>

                                            <div class="col-lg-2 col-md-2 col-12">
                                                <!-- Featured status column -->
                                                @if ($ad->is_featured)
                                                    <span class="badge bg-success"><i class="lni lni-diamond-alt"
                                                            style="color: gold"></i>
                                                        Featured</span>
                                                @else
                                                    <div class="mb-0 form-group button">
                                                        <button type="button" class="btnn" data-bs-toggle="modal"
                                                            data-bs-target="#featureModal{{ $ad->id }}">
                                                            Feature this Ad
                                                        </button>
                                                    </div>


                                                    <!-- Modal for featuring the ad -->
                                                    <div class="modal fade" id="featureModal{{ $ad->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="featureModalLabel{{ $ad->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="featureModalLabel{{ $ad->id }}">Feature
                                                                        Ad</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('ad.feature', $ad->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="featured_days"
                                                                                class="form-label">Number of days to feature
                                                                                this ad:</label>
                                                                            <input type="number" class="form-control"
                                                                                id="featured_days{{ $ad->id }}"
                                                                                name="featured_days" min="1"
                                                                                required>
                                                                            <div id="coinMessage{{ $ad->id }}"
                                                                                class="mt-2" style="color: #5830e0"></div>
                                                                            <div id="coinError{{ $ad->id }}"
                                                                                class="mt-2 text-danger"></div>
                                                                        </div>
                                                                        <div class="mb-0 form-group button">
                                                                            <button type="submit" class="btn"
                                                                                id="featureButton{{ $ad->id }}"
                                                                                disabled>
                                                                                Feature Ad
                                                                            </button>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const featuredDaysInput = document.getElementById('featured_days{{ $ad->id }}');
                                                    const coinMessage = document.getElementById('coinMessage{{ $ad->id }}');
                                                    const coinError = document.getElementById('coinError{{ $ad->id }}');
                                                    const featureButton = document.getElementById('featureButton{{ $ad->id }}');

                                                    const featuredAdRate = {{ $featuredAdRate }};

                                                    const userCoins = {{ $user->coins }}; // Replace with actual user coins variable

                                                    featuredDaysInput.addEventListener('input', function() {
                                                        const days = parseInt(featuredDaysInput.value) || 0;
                                                        const requiredCoins = days * featuredAdRate;

                                                        if (days > 0) {
                                                            coinMessage.textContent = `Additional ${requiredCoins} coins will be deducted.`;
                                                            coinError.textContent = '';
                                                            if (requiredCoins > userCoins) {
                                                                coinError.textContent = 'Sorry, you do not have enough coins.';
                                                                featureButton.disabled = true;
                                                            } else {
                                                                featureButton.disabled = false;
                                                            }
                                                        } else {
                                                            coinMessage.textContent = '';
                                                            coinError.textContent = '';
                                                            featureButton.disabled = true;
                                                        }
                                                    });
                                                });
                                            </script>


                                            <div class="col-lg-2 col-md-2 col-12 text-end">
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

                                <!-- Pagination -->
                                <div style="justify-content:center" class="pagination center">
                                    <ul class="pagination-list">
                                        @if ($ads->onFirstPage())
                                            <li class="disabled"><a href="javascript:void(0)"><i
                                                        class="lni lni-chevron-left"></i></a></li>
                                        @else
                                            <li><a href="{{ $ads->previousPageUrl() }}"><i
                                                        class="lni lni-chevron-left"></i></a></li>
                                        @endif

                                        @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                            <li class="{{ $ads->currentPage() == $page ? 'active' : '' }}">
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($ads->hasMorePages())
                                            <li><a href="{{ $ads->nextPageUrl() }}"><i
                                                        class="lni lni-chevron-right"></i></a></li>
                                        @else
                                            <li class="disabled"><a href="javascript:void(0)"><i
                                                        class="lni lni-chevron-right"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <!-- End Pagination -->

                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
