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
                                    @if (!empty($ad->pictures) && is_array($ad->pictures))
                                        <img src="{{ asset('storage/' . $ad->pictures[0]) }}" id="current"
                                            alt="Main Picture" class="img-thumbnail" style="width: 750px; height: 500px;">
                                    @else
                                        <span>@lang('messages.no_picture')</span>
                                    @endif
                                </div>
                                <div class="images">
                                    @if (!empty($ad->pictures) && is_array($ad->pictures))
                                        @foreach ($ad->pictures as $picture)
                                            <img src="{{ asset('storage/' . $picture) }}" class="img"
                                                style="max-height: 100px; max-width:120px;" alt="Thumbnail Picture">
                                        @endforeach
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


                            <div class="single-block comments">
                                <!-- Alerts Section -->
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

                                @if ($user->coins >= $ad->coins_needed)
                                    <!-- Bid Form -->
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
                                    <!-- Not Enough Coins Message -->
                                    <div class="mt-3 alert alert-danger">
                                        You don't have enough coins to bid on this ad.
                                    </div>
                                @endif

                            </div>

                            <div class="list-info">
                                <h4>Coins</h4>
                                <ul>
                                    <div class="row">
                                        <li class="col-md-4"><span>@lang('messages.coins_required')</span> {{ $ad->coins_needed }}</li>
                                        <li class="col-md-4"><span>@lang('messages.available_coins')</span> {{ auth()->user()->coins }}
                                        </li>
                                        <li class="col-md-4"><span>@lang('messages.no_of_bids')</span> {{ $ad->bids->count() }}</li>
                                    </div>



                                </ul>
                                <h4>Informations</h4>
                                <ul>

                                    <li><span>@lang('messages.type'):</span>{{ $ad->type }}</li>
                                    <li><span>@lang('messages.category'):</span>{{ $ad->category->name }}</li>
                                    <li><span>@lang('messages.status'):</span>{{ $ad->is_verified == 1 ? 'Verified' : 'Not Verified' }}
                                    </li>
                                    <li><span>@lang('messages.created_on')</span>{{ \Carbon\Carbon::parse($ad->created_at)->format('F j, Y ') }}
                                    </li>
                                    <li><span>@lang('messages.updated_on')</span>{{ \Carbon\Carbon::parse($ad->updated_at)->format('F j, Y ') }}
                                        <button type="button" class="btn btn-sm"
                                            style="background-color:none; border-color:none; color:#232323;"
                                            data-bs-toggle="modal" data-bs-target="#reportModal">
                                            <i class="lni lni-flag"></i><span>@lang('messages.report_this_ad')</span>

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
                                                        <option value="Inappropriate Content">Inappropriate Content</option>
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
                            <h3>@lang('messages.description')</h3>
                            <p>{{ $ad->description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            <div class="single-block author">
                                <h3>@lang('messages.seller')</h3>
                                <div class="content">
                                    <img src="{{ $ad->user->profile_pic ? asset('storage/' . $ad->user->profile_pic) : asset('frontend/assets/images/user/user.png') }}"
                                        alt="Seller">


                                    <a href="{{ route('profile.public', $ad->createdBy->id) }}">
                                        <h4>{{ $ad->createdBy->first_name ?? 'Unknown' }}
                                            {{ $ad->createdBy->last_name }}</h4>
                                    </a>
                                    <div class="user-rating">

                                        <div class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($averageRating >= $i)
                                                    <i class="fa fa-star text-warning"></i>
                                                @elseif ($averageRating >= $i - 0.5)
                                                    <i class="fa fa-star-half-alt text-warning"></i>
                                                @else
                                                    <i class="fa fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span>({{ number_format($averageRating, 1) }})</span>
                                        </div>
                                    </div>

                                    <span>
                                        {{ $ad->createdBy->created_at ? 'Member since ' . \Carbon\Carbon::parse($ad->createdBy->created_at)->format('F Y') : 'Unknown' }}
                                    </span>
                                </div>
                            </div>



                            <!-- End Single Block -->

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
