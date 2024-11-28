@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Cities Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-primary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-city mdi-48px"></i>
                        <h5>Total Countries</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $countries }}</h3>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-primary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-city mdi-48px"></i>
                        <h5>Total Cities</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $cities }}</h3>
                    </div>
                </div>
            </div>

            <!-- Localities Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-success">
                    <div class="text-center card-header">
                        <i class="mdi mdi-home-city mdi-48px"></i>
                        <h5>Total Localities</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $localities }}</h3>
                    </div>
                </div>
            </div>

            <!-- Active Ads Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-info">
                    <div class="text-center card-header">
                        <i class="mdi mdi-newspaper mdi-48px"></i>
                        <h5>Active Ads</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $ads }}</h3>
                    </div>
                </div>
            </div>



            <!-- Disabled Ads Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-danger">
                    <div class="text-center card-header">
                        <i class="mdi mdi-card mdi-48px"></i>
                        <h5>Disabled Ads</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $disableAds }}</h3>
                    </div>
                </div>
            </div>

            <!-- Categories Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-warning">
                    <div class="text-center card-header">
                        <i class="mdi mdi-view-list mdi-48px"></i>
                        <h5>Total Categories</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $categories }}</h3>
                    </div>
                </div>
            </div>

            <!-- Professions Count Card -->
            <div class="mb-4 col-md-4">
                <div class="text-white card bg-secondary">
                    <div class="text-center card-header">
                        <i class="mdi mdi-briefcase-check mdi-48px"></i>
                        <h5>Total Professions</h5>
                    </div>
                    <div class="text-center card-body">
                        <h3>{{ $professions }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
