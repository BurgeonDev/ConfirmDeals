@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Total Countries Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-primary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-city mdi-36px"></i>
                        <h6>Total Countries</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $countries }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Cities Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-primary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-city mdi-36px"></i>
                        <h6>Total Cities</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $cities }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Localities Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-success">
                    <div class="text-center card-header">
                        <i class="mdi mdi-home-city mdi-36px"></i>
                        <h6>Total Localities</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $localities }}</h4>
                    </div>
                </div>
            </div>

            <!-- Active Ads Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-info">
                    <div class="text-center card-header">
                        <i class="mdi mdi-newspaper mdi-36px"></i>
                        <h6>Active Ads</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $ads }}</h4>
                    </div>
                </div>
            </div>

            <!-- Disabled Ads Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-danger">
                    <div class="text-center card-header">
                        <i class="mdi mdi-card mdi-36px"></i>
                        <h6>Cancel Ads</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $disableAds }}</h4>
                    </div>
                </div>
            </div>

            <!-- Featured Ads Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-warning">
                    <div class="text-center card-header">
                        <i class="mdi mdi-star mdi-36px"></i>
                        <h6>Featured Ads</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $featuredAds }}</h4>
                    </div>
                </div>
            </div>

            <!-- Expired Ads Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-dark">
                    <div class="text-center card-header">
                        <i class="mdi mdi-calendar-clock mdi-36px"></i>
                        <h6>Expired Ads</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $expiredAds }}</h4>
                    </div>
                </div>
            </div>

            <!-- Pending Ads Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-secondary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-timer-sand mdi-36px"></i>
                        <h6>Pending Ads</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $pendingAds }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Categories Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-warning">
                    <div class="text-center card-header">
                        <i class="mdi mdi-view-list mdi-36px"></i>
                        <h6>Total Categories</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $categories }}</h4>
                    </div>
                </div>
            </div>

            <!-- Total Professions Count Card -->
            <div class="mb-3 col-md-3">
                <div class="text-white card bg-secondary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-briefcase-check mdi-36px"></i>
                        <h6>Total Professions</h6>
                    </div>
                    <div class="text-center card-body">
                        <h4>{{ $professions }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
