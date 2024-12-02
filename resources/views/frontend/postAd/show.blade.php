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
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    @if (!empty($ad->pictures) && is_array($ad->pictures))
                                        <img src="{{ asset('storage/' . $ad->pictures[0]) }}" alt="Ad Picture"
                                            class="img-thumbnail" style="width: 750px; height: 450px;">
                                    @else
                                        <span>No Picture</span>
                                    @endif
                                </div>
                            </main>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $ad->title }}</h2>

                            <p class="location"><i class="lni lni-map-marker"></i>
                                <a href="javascript:void(0)">

                                    {{ $ad->locality->name ?? 'Locality Not Found' }},
                                    {{ $ad->city->name ?? 'City Not Found' }}
                                </a>
                            </p>
                            <h3 class="price">Pkr {{ $ad->price }}</h3>
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
                                <form action="{{ route('bids.place', $ad->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <div class="me-2 button"> <button type="submit" class="btn">Place
                                                    Bid</button>
                                            </div>
                                            <div class="button me-2" style="flex-grow: 1;">

                                                <input style="height: 52px;" type="number" name="offer"
                                                    class="form-control form-control-custom" placeholder="Enter bid amount"
                                                    required>


                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="list-info">
                                <h4>Informations</h4>
                                <ul>
                                    <li><span>Type:</span>{{ $ad->type }}</li>
                                    <li><span>Category:</span>{{ $ad->category->name }}</li>
                                    <li><span>Status:</span>{{ $ad->is_verified == 1 ? 'Verified' : 'Not Verified' }}</li>
                                    <li><span>Created On:</span>{{ $ad->created_at }}</li>
                                    <li><span>Updated On:</span>{{ $ad->updated_at }}</li>

                                </ul>

                            </div>
                            <div class="contact-info">
                                <ul>

                                    <li>
                                        <a href="tel:{{ $ad->createdBy->phone_number ?? '' }}" class="call">
                                            <i class="lni lni-phone-set"></i>
                                            {{ $ad->createdBy->phone_number ?? 'No Phone Number' }}
                                            <span>Call &amp; Get more info</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:{{ $ad->createdBy->email ?? 'example@gmail.com' }}" class="mail">
                                            <i class="lni lni-envelope"></i>
                                        </a>

                                    </li>
                                </ul>
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
                        <!-- End Single Block -->

                        <!-- Start Feedback Section -->
                        <div class="single-block comments">
                            <h3>Comments</h3>
                            @if ($ad->feedbacks->isEmpty())
                                <p>No feedback available for this ad.</p>
                            @else
                                @foreach ($ad->feedbacks as $feedback)
                                    <div class="single-comment">
                                        <!-- Display user profile picture -->
                                        <img src="{{ $feedback->user && $feedback->user->profile_pic ? asset('storage/' . $feedback->user->profile_pic) : asset('frontend/assets/images/user/user.png') }}"
                                            alt="User Profile Picture" class="comment-profile-pic">
                                        <div class="content">
                                            <h4 class="name-with-icon">{{ $feedback->name }}</h4>
                                            <p>{{ $feedback->email }}</p>
                                            <span>{{ $feedback->created_at->format('d M, Y') }}</span>
                                            <p>{{ $feedback->comments }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                        <div class="single-block comment-form">
                            <h3>Post a Comment</h3>
                            <form action="{{ route('feedback.store', $ad->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="ad_id" value="{{ $ad->id }}">

                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <!-- Store the authenticated user's ID -->

                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="text" name="name" class="form-control form-control-custom"
                                                value="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}"
                                                placeholder="Your Name" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="email" name="email" class="form-control form-control-custom"
                                                value="{{ auth()->user()->email }}" placeholder="Your Email" required
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-box form-group">
                                            <textarea name="comments" class="form-control form-control-custom" placeholder="Your Comments" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="button">
                                            <button type="submit" class="btn">Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Single Block -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            <div class="single-block author">
                                <h3>Seller</h3>
                                <div class="content">
                                    <img src="{{ asset('storage/' . $ad->user->profile_pic) ?? asset('frontend/assets/images/user/user.png') }}"
                                        alt="Seller">

                                    <h3>{{ $ad->createdBy->first_name ?? 'Unknown' }}
                                        {{ $ad->createdBy->last_name }}</h3>
                                    <h4>{{ $ad->createdBy->email ?? 'Unknown' }}</h4>
                                </div>
                            </div>
                            <div class="single-block">
                                <h3>Location</h3>
                                <div class="mapouter">
                                    <div class="gmap_canvas">
                                        @if ($ad->locality && $ad->locality->name)
                                            <iframe width="100%" height="300" id="gmap_canvas"
                                                src="https://maps.google.com/maps?q={{ $ad->locality->name }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                frameborder="0" scrolling="no" marginheight="0"
                                                marginwidth="0"></iframe>
                                        @elseif ($ad->city)
                                            <iframe width="100%" height="300" id="gmap_canvas"
                                                src="https://maps.google.com/maps?q={{ $ad->city }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                frameborder="0" scrolling="no" marginheight="0"
                                                marginwidth="0"></iframe>
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


                            <!-- End Single Block -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
