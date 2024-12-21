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
                                            <span>@lang('messages.total_ad_posted')</span>
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
                                            <span>@lang('messages.total_verified_ads')</span>
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
                                            <span>@lang('messages.total_not_verified_ads')</span>
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
