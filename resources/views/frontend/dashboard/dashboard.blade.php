@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Dashbaord</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="main-content">
                        <!-- Start Details Lists -->
                        <div class="details-lists">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list">
                                        <div class="list-icon">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </div>
                                        <h3>
                                            {{ $ads->count() }}
                                            <span>Total Ad Posted</span>

                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list two">
                                        <div class="list-icon">
                                            <i class="lni lni-bolt"></i>
                                        </div>
                                        <h3>
                                            {{ $verifiedAdsCount }}
                                            <span>Total Verified Ads</span>

                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list three">
                                        <div class="list-icon">
                                            <i class="lni lni-emoji-sad"></i>
                                        </div>
                                        <h3>
                                            {{ $unverifiedAdsCount }}
                                            <span>Total Not Verified Ads</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>
                        </div>

                        <!-- End Details Lists -->
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-12">
                                <!-- Start Activity Log -->
                                <div class="activity-log dashboard-block">
                                    <h3 class="block-title">My Activity Log</h3>
                                    <ul>
                                        @forelse($activities as $activity)
                                            <li>
                                                <div class="log-icon">
                                                    <i class="{{ $activity['icon'] }}"></i>
                                                </div>
                                                <a href="javascript:void(0)" class="title">{{ $activity['title'] }}</a>
                                                <span class="time">{{ $activity['time'] }}</span>
                                                <span class="remove">
                                                    <a href="javascript:void(0)"><i class="lni lni-close"></i></a>
                                                </span>
                                            </li>
                                        @empty
                                            <li>
                                                <div class="log-icon">
                                                    <i class="lni lni-info"></i>
                                                </div>
                                                <a href="javascript:void(0)" class="title">No activities recorded</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>

                                <!-- End Activity Log -->
                            </div>
                            {{-- <div class="col-lg-6 col-md-12 col-12">
                                <!-- Start Recent Items -->
                                <div class="recent-items dashboard-block">
                                    <h3 class="block-title">Recent Ads</h3>
                                    <ul>
                                        <li>
                                            <div class="image">
                                                <a href="javascript:void(0)"><img
                                                        src="assets/images/dashboard/recent-items/item1.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <a href="javascript:void(0)" class="title">iPhone 11 Pro Max</a>
                                            <span class="time">12 Minutes Ago</span>
                                            <span class="remove"><a href="javascript:void(0)"><i
                                                        class="lni lni-close"></i></a></span>
                                        </li>
                                        <li>
                                            <div class="image">
                                                <a href="javascript:void(0)"><img
                                                        src="assets/images/dashboard/recent-items/item2.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <a href="javascript:void(0)" class="title">Polaris 600 Assault 144</a>
                                            <span class="time">5 days Ago</span>
                                            <span class="remove"><a href="javascript:void(0)"><i
                                                        class="lni lni-close"></i></a></span>
                                        </li>
                                        <li>
                                            <div class="image">
                                                <a href="javascript:void(0)"><img
                                                        src="assets/images/dashboard/recent-items/item3.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <a href="javascript:void(0)" class="title">Brand New Bagpack</a>
                                            <span class="time">1 week Ago</span>
                                            <span class="remove"><a href="javascript:void(0)"><i
                                                        class="lni lni-close"></i></a></span>
                                        </li>
                                        <li>
                                            <div class="image">
                                                <a href="javascript:void(0)"><img
                                                        src="assets/images/dashboard/recent-items/item4.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <a href="javascript:void(0)" class="title">Honda Civic VTi 2023</a>
                                            <span class="time">3 week Ago</span>
                                            <span class="remove"><a href="javascript:void(0)"><i
                                                        class="lni lni-close"></i></a></span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Recent Items -->
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
