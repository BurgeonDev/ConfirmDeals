@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Ad Details</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Ad Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-12">
                        <div class="product-images">

                            <main id="gallery">
                                <div class="main-img">
                                    @if (!empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0)
                                        <img src="{{ asset('storage/' . $ad->pictures[0]) }}" id="current"
                                            alt="Main Picture" class="img-thumbnail" style="width: 750px; height: 500px;">
                                    @else
                                        <img src="{{ asset('assets/images/default-image.jpg') }}" id="current"
                                            alt="Default Picture" class="img-thumbnail"
                                            style="width: 750px; height: 500px;">
                                    @endif
                                </div>
                                <div class="images">
                                    @if (!empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0)
                                        @foreach ($ad->pictures as $picture)
                                            <img src="{{ asset('storage/' . $picture) }}" class="img"
                                                style="max-height: 100px; max-width:120px;" alt="Thumbnail Picture">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('assets/images/default-image.jpg') }}" class="img"
                                            style="max-height: 100px; max-width:120px;" alt="Default Thumbnail">
                                    @endif
                                </div>
                            </main>


                        </div>

                    </div>
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $ad->title }}</h2>

                            <p class="location"><i class="lni lni-map-marker"></i>
                                <a href="javascript:void(0)">

                                    {{ $ad->locality->name ?? 'Locality Not Found' }},
                                    {{ $ad->city->name ?? 'City Not Found' }}
                                </a>
                            </p>
                            <h3 class="price">Pkr {{ number_format($ad->price) }}</h3>
                            @if (auth()->id() !== $ad->user_id)
                                <div class="single-block comments">
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
                                    @php
                                        $user = auth()->user();
                                    @endphp
                                    @if ($ad->type === 'product')
                                        @if ($user->coins >= $ad->coins_needed)
                                            <form action="{{ route('bids.place', $ad->id) }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-8 d-flex align-items-center">
                                                        <div class="me-2 button">
                                                            <button type="submit" class="btn">@lang('messages.bid')</button>
                                                        </div>
                                                        <div class="button me-2" style="flex-grow: 1;">
                                                            <input style="height: 52px;" type="number" name="offer"
                                                                class="form-control form-control-custom"
                                                                placeholder="@lang('messages.enter_bid_amount')" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="mt-3 alert alert-danger">
                                                You don't have enough coins to bid on this ad.
                                            </div>
                                        @endif
                                    @elseif ($ad->type === 'service')
                                        @if ($user->coins >= $ad->coins_needed)
                                            <div class="me-2 button">

                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#hireMeModal">
                                                    @lang('messages.hire_me')
                                                </button>
                                            </div>
                                            <div class="modal fade" id="hireMeModal" tabindex="-1"
                                                aria-labelledby="hireMeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hireMeModalLabel">Hire Service</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('bids.place', $ad->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="offer" class="form-label">Proposed
                                                                        Offer</label>
                                                                    <input type="number" class="form-control"
                                                                        id="offer" name="offer"
                                                                        placeholder="Enter your offer" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="notes" class="form-label">Additional
                                                                        Notes</label>
                                                                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Write any additional details"></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="time_slots" class="form-label">Available
                                                                        Time
                                                                        Slots</label>
                                                                    <input type="text" class="form-control"
                                                                        id="time_slots" name="time_slots"
                                                                        placeholder="Enter available time slots (e.g., 9am-11am)">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer button">
                                                                <button type="submit" class="btn">Submit
                                                                    Proposal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="mt-3 alert alert-danger">
                                                You don't have enough coins to hire this service.
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif

                            <div class="list-info">
                                @if (auth()->id() !== $ad->user_id)
                                    <h4>Coins</h4>

                                    <ul>
                                        <div class="row">
                                            <li class="col-md-4"><span>@lang('messages.coins_required')</span> {{ $ad->coins_needed }}
                                            </li>
                                            <li class="col-md-4"><span>@lang('messages.available_coins')</span>
                                                {{ auth()->user()->coins }}</li>
                                        </div>
                                    </ul>
                                @endif

                                <h4>Informations</h4>
                                <ul>

                                    <li><span>@lang('messages.type'):</span>{{ $ad->type }}</li>
                                    <li><span>@lang('messages.category'):</span>{{ $ad->category->name }}</li>
                                    <li><span>@lang('messages.status'):</span>{{ $ad->is_verified == 1 ? 'Verified' : 'Not Verified' }}
                                    </li>
                                    <li class="col-md-4"><span>@lang('messages.no_of_bids')</span> {{ $ad->bids->count() }}</li>
                                    <li><span>@lang('messages.created_on')</span>{{ \Carbon\Carbon::parse($ad->created_at)->format('F j, Y ') }}
                                    </li>
                                    <li><span>@lang('messages.updated_on')</span>{{ \Carbon\Carbon::parse($ad->updated_at)->format('F j, Y ') }}

                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color:none; border-color:none; color:#232323;"
                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                            <i class="lni lni-flag"></i><span style="color: red">@lang('messages.report_this_ad')</span>

                                        </button>
                                    </li>



                                </ul>

                            </div>

                            <!-- Report Modal -->
                            <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reportModalLabel">Report Ad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('report.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">Reason</label>
                                                    <select name="reason" id="reason" class="form-select" required>
                                                        <option value="">Select a reason</option>
                                                        <option value="Spam">Spam</option>
                                                        <option value="Inappropriate Content">Inappropriate Content
                                                        </option>
                                                        <option value="Fraud or Scam">Fraud or Scam</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea name="description" id="description" class="form-control" placeholder="Provide additional details"
                                                        rows="4" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer button">

                                                <button type="submit" class="btn">Submit
                                                    Report</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Single Block -->

                </div>
            </div>
            <div class="item-details-blocks">
                <div class="row">

                    <div class="col-lg-8 col-md-7 col-12">
                        <!-- Start Single Block -->
                        <div class="single-block description">
                            <h3>Description</h3>
                            <p>{{ $ad->description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">

                            <div class="single-block author">
                                <h3>@lang('messages.seller')</h3>
                                <div class="content">
                                    <img src="{{ $ad->user->profile_pic ? asset('storage/' . $ad->user->profile_pic) : asset('frontend/assets/images/user/user.png') }}"
                                        alt="Seller">
                                    <a href="{{ route('profile.public', $ad->createdBy->id) }}">
                                        <h3 style="color: #5830e0">Seller</h3>
                                    </a>
                                    <div class="user-rating">
                                        @if ($averageRating)
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($averageRating))
                                                        <i class="fas fa-star" style="color: gold;"></i>
                                                        <!-- Filled star -->
                                                    @elseif ($i <= ceil($averageRating))
                                                        <i class="fas fa-star-half-alt" style="color: gold;"></i>
                                                        <!-- Half star -->
                                                    @else
                                                        <i class="far fa-star" style="color: gold;"></i>
                                                        <!-- Empty star -->
                                                    @endif
                                                @endfor
                                                <span>({{ number_format($averageRating, 1) }} / 5)</span>
                                            </div>
                                        @else
                                            <span>No ratings yet</span>
                                        @endif
                                    </div>
                                    <span>
                                        {{ $ad->createdBy->created_at ? 'Member since ' . \Carbon\Carbon::parse($ad->createdBy->created_at)->format('F Y') : 'Unknown' }}
                                    </span>

                                    <a href="{{ route('profile.public', $ad->createdBy->id) }}" class="see-all">See All
                                        Ads</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-block">
                    <h3>@lang('messages.location')</h3>
                    <div class="mapoute col-lg-12">
                        <div class="gmap_canvas">
                            @if ($ad->locality && $ad->locality->name)
                                <iframe width="100%" height="300" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q={{ $ad->locality->name }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            @elseif ($ad->city)
                                <iframe width="100%" height="300" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q={{ $ad->city }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            @else
                                <p>Location not available</p>
                            @endif

                            <a href="https://putlocker-is.org"></a><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 300px;
                                    width: 100%;
                                }
                            </style>
                            <a href="https://www.embedgooglemap.net">google map code for website</a>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 300px;
                                    width: 100%;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        const current = document.getElementById("current");
        const opacity = 0.6;
        const imgs = document.querySelectorAll(".img");
        imgs.forEach(img => {
            img.addEventListener("click", (e) => {
                //reset opacity
                imgs.forEach(img => {
                    img.style.opacity = 1;
                });
                current.src = e.target.src;
                //adding class
                //current.classList.add("fade-in");
                //opacity
                e.target.style.opacity = opacity;
            });
        });
    </script>
@endsection
