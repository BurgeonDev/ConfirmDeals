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
                                {{-- <div class="images">
                                    <img src="assets/images/item-details/image1.jpg" class="img" alt="#">
                                    <img src="assets/images/item-details/image2.jpg" class="img" alt="#">
                                    <img src="assets/images/item-details/image3.jpg" class="img" alt="#">
                                    <img src="assets/images/item-details/image4.jpg" class="img" alt="#">
                                    <img src="assets/images/item-details/image5.jpg" class="img" alt="#">
                                </div> --}}
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
                                        <a href="tel:+002562352589" class="call">
                                            <i class="lni lni-phone-set"></i>
                                            +00 256 235 2589
                                            <span>Call &amp; Get more info</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:example@gmail.com" class="mail">
                                            <i class="lni lni-envelope"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-details-blocks">
                <div class="row">
                    {{-- <div class="col-lg-8 col-md-7 col-12">
                        <!-- Start Single Block -->
                        <div class="single-block description">
                            <h3>Description</h3>
                            <p>
                                {{ $ad->description }}
                            </p>
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comments">
                            <h3>Comments</h3>
                            <!-- Start Single Comment -->
                            <div class="single-comment">
                                <img src="assets/images/testimonial/testi2.jpg" alt="#">
                                <div class="content">
                                    <h4>Luis Havens</h4>
                                    <span>25 Feb, 2023</span>
                                    <p>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </p>
                                    <a href="javascript:void(0)" class="reply"><i class="lni lni-reply"></i> Reply</a>
                                </div>
                            </div>
                            <!-- End Single Comment -->
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comment-form">
                            <h3>Post a comment</h3>
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="text" name="name" class="form-control form-control-custom"
                                                placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="email" name="email" class="form-control form-control-custom"
                                                placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-box form-group">
                                            <textarea name="#" class="form-control form-control-custom" placeholder="Your Comments"></textarea>
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
                    </div> --}}
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

                                        {{-- <div class="content">

                                            <h4>{{ $feedback->name }}</h4>
                                            <i class="fas fa-user"></i>
                                            <p>{{ $feedback->email }}</p>
                                            <span>{{ $feedback->created_at->format('d M, Y') }}</span>
                                            <p>{{ $feedback->comments }}</p>
                                        </div> --}}
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
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="text" name="name" class="form-control form-control-custom"
                                                placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="email" name="email" class="form-control form-control-custom"
                                                placeholder="Your Email" required>
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
                                    <h3>{{ $ad->createdBy->name ?? 'Unknown' }}</h3>
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

                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            {{-- <div class="single-block contant-seller comment-form ">
                                <h3>Contact Seller</h3>
                                <form action="#" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="text" name="name"
                                                    class="form-control form-control-custom" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="email" name="email"
                                                    class="form-control form-control-custom" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <textarea name="#" class="form-control form-control-custom" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button">
                                                <button type="submit" class="btn">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block ">
                                <h3>Location</h3>
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas"
                                            src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                            href="https://putlocker-is.org"></a><br>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                height: 300px;
                                                width: 100%;
                                            }
                                        </style><a href="https://www.embedgooglemap.net">google map code for website</a>
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
                            </div> --}}
                            <!-- End Single Block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
