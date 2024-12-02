@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Bids</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Bids</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        <div class="mt-0 dashboard-block">

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
                            <h3 class="block-title">My Bids on Other Ads</h3>
                            <div class="inner-block">
                                <div class="post-ad-tab">

                                    <!-- Start Items Area -->
                                    <div class="mt-4 bids-container">
                                        @forelse ($bids as $bid)
                                            <div class="mb-4 shadow-sm card">
                                                <div class="text-white card-header">
                                                    <h4 style="color: #582fe0" class="mb-0"><a
                                                            href="{{ route('ad.show', $bid->ad->id) }}">{{ $bid->ad->title }}</a>
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div
                                                        class="p-3 mb-3 border rounded bid-item d-flex justify-content-between align-items-center">
                                                        <!-- Left Section: Bid Details -->
                                                        <div class="bid-details">
                                                            <p class="mb-1"><strong>Offer:</strong> ${{ $bid->offer }}
                                                            </p>
                                                            <p class="mb-1"><strong>Status:</strong>
                                                                @if ($bid->status === 'accepted')
                                                                    <span class="badge bg-success">Accepted</span>
                                                                @elseif ($bid->status === 'rejected')
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @else
                                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">You have not placed any bids yet.</p>
                                        @endforelse
                                    </div>
                                    <!-- End Items Area -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
