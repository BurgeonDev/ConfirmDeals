@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Total Countries Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Countries</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('countries.index') }}">{{ $countries }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-city mdi-36px text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Cities Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Cities</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('cities.index') }}">{{ $cities }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-city mdi-36px text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Localities Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Localities</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('localities.index') }}">{{ $localities }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-home-city mdi-36px text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Ads Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Active Ads</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('ads.index') }}">{{ $ads }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-newspaper mdi-36px text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancelled Ads Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Cancelled Ads</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('ads.index') }}">{{ $disableAds }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-card mdi-36px text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Ads Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Featured Ads</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('ads.index') }}">{{ $featuredAds }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-star mdi-36px text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expired Ads Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Expired Ads</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('ads.index') }}">{{ $expiredAds }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-calendar-clock mdi-36px text-dark"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Ads Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Pending Ads</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('ads.index') }}">{{ $pendingAds }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-timer-sand mdi-36px text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Active Users -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Active Users</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('admin.userManagement') }}">{{ $users }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="fa fa-users fa-3x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Categories</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('categories.index') }}">{{ $categories }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-view-list mdi-36px text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Professions Count Card -->
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="statistics-title">Total Professions</p>
                            <h3 class="rate-percentage">
                                <a href="{{ route('professions.index') }}">{{ $professions }}</a>
                            </h3>
                        </div>
                        <div>
                            <i class="mdi mdi-briefcase-check mdi-36px text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
