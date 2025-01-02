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
                            <div class="row" style="padding: 5px;">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list">
                                        <div class="list-icon">
                                            <i class="lni lni-checkmark-circle"></i>
                                        </div>
                                        <h3>
                                            {{ $ads->count() }}
                                            <span>Total Ads Posted</span>
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
                                            <span>Verified Ads</span>
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
                                            <span>Pending Ads</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>
                            <div class="row" style="padding: 5px;">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list">
                                        <div class="list-icon">
                                            <i class="lni lni-close"></i>
                                        </div>
                                        <h3>
                                            {{ $cancelledAdsCount }}
                                            <span>Cancelled Ads</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list four">
                                        <div class="list-icon">
                                            <i class="lni lni-star"></i>
                                        </div>
                                        <h3>
                                            {{ $featuredAdsCount }}
                                            <span>Featured Ads</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <!-- Start Single List -->
                                    <div class="single-list five">
                                        <div class="list-icon">
                                            <i class="lni lni-handshake"></i>
                                        </div>
                                        <h3>
                                            {{ $dealsCount }}
                                            <span>Deals</span>
                                        </h3>
                                    </div>
                                    <!-- End Single List -->
                                </div>
                            </div>

                        </div>


                        <!-- End Details Lists -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">

                                <div class="activity-log dashboard-block"
                                    style="background: #fff; border: 1px solid #ddd; padding: 20px; border-radius: 8px; text-align: center;">
                                    <h3 class="block-title"
                                        style="margin-bottom: 20px; font-size: 18px; font-weight: bold; color: #333;">
                                        Profile Completed</h3>
                                    <div class="progress-container" style="position: relative; margin: 20px 0;">
                                        <div class="progress"
                                            style="background: #f5f5f5; border-radius: 50px; height: 20px; overflow: hidden;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $completionPercentage }}%; background: linear-gradient(90deg, #00c6ff, #6610f2); height: 100%; transition: width 0.4s ease;"
                                                aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <span class="progress-percentage"
                                            style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); font-weight: bold; color: #000;">{{ $completionPercentage }}%</span>
                                    </div>
                                    <p style="margin-top: 10px; font-size: 14px; color: #666;">Complete Profile For Better
                                        Experience</p>
                                </div>


                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <!-- Start Activity Log -->
                                <div class="activity-log dashboard-block">
                                    <h3 class="block-title">@lang('messages.my_activity_log')</h3>
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
                                                <a href="javascript:void(0)" class="title">@lang('messages.no_activities_recorded')</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
