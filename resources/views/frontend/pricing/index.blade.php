@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Coins Pricing</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Price</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s"
                            style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Coin Pricing Plan
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"
                            style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Affordable coin
                            packages designed to boost your ad reach and visibility, tailored for every budget</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="price">
                                <h2 class="amount">PKR 0</h2>
                            </div>
                            <h4 class="title">Free</h4>
                        </div>
                        <!-- End Table Head -->
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> 10</li>
                            <li><strong>Listings:</strong> 1 ad posting</li>
                            <li><strong>Access Level:</strong> Basic access to the platform</li>
                            <li><strong>Visibility:</strong> Standard visibility in the listings</li>
                            <li><strong>Limitations:</strong> No promotional tools, single ad posting, basic category ads
                            </li>
                        </ul>
                        <!-- End Table List -->
                        <!-- Table Bottom -->
                        <div class="button">
                            <a class="btn" href="javascript:void(0)">Select Plan</a>
                        </div>
                        <!-- End Table Bottom -->
                    </div>
                    <!-- End Single Table-->
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="price">
                                <h2 class="amount">PKR 500</h2>
                            </div>
                            <h4 class="title">Standard</h4>
                        </div>
                        <!-- End Table Head -->
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> 100</li>
                            <li><strong>Ad Postings:</strong> Multiple non-featured ads</li>
                            <li><strong>Visibility:</strong> Higher visibility than Free plan</li>
                            <li><strong>Promotional Tools:</strong> Basic promotional tools to attract views</li>
                            <li><strong>Audience Reach:</strong> Optimized to reach a broader audience</li>
                            <li><strong>Limitations:</strong> Non-featured ads</li>
                        </ul>
                        <!-- End Table List -->
                        <!-- Table Bottom -->
                        <div class="button">
                            <a class="btn" href="javascript:void(0)">Select Plan</a>
                        </div>
                        <!-- End Table Bottom -->
                    </div>
                    <!-- End Single Table-->
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="price">
                                <h2 class="amount">PKR 1000</h2>
                            </div>
                            <h4 class="title">Premium</h4>
                        </div>
                        <!-- End Table Head -->
                        <!-- Table List -->
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> 500</li>
                            <li><strong>Ad Postings:</strong> Unlimited ad postings</li>
                            <li><strong>Visibility:</strong> Maximum visibility and exposure</li>
                            <li><strong>Promotional Tools:</strong> Advanced tools to boost your ads</li>
                            <li><strong>Featured Ads:</strong> Your ads appear at the top of the listings</li>
                            <li><strong>Audience Reach:</strong> Maximum audience engagement</li>
                        </ul>
                        <!-- End Table List -->
                        <!-- Table Bottom -->
                        <div class="button">
                            <a class="btn" href="javascript:void(0)">Select Plan</a>
                        </div>
                        <!-- End Table Bottom -->
                    </div>
                    <!-- End Single Table-->
                </div>

            </div>
        </div>
    </section>
@endsection
