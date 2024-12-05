@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Bids on Your Ads</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Bids on Your Ads</li>
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
                            <h3 class="block-title">Bids for Your Ads</h3>
                            <div class="inner-block">
                                <div class="post-ad-tab">
                                    <div class="mt-4">
                                        <div class="row">
                                            @foreach ($ads as $ad)
                                                <div class="col-md-12">
                                                    <div class="p-4 mb-3 border rounded shadow-sm bid-item d-flex justify-content-between align-items-center"
                                                        style="background-color: #f8f9fa; border-color: #e0e0e0;">
                                                        <div
                                                            class="d-flex flex-column flex-md-row justify-content-between w-100">
                                                            <!-- Ad Title -->
                                                            <div class="mb-2 mb-md-0">
                                                                <h4 style="color: #582fe0;" class="mb-0">
                                                                    <a href="{{ route('ad.show', $ad->id) }}"
                                                                        class="text-decoration-none ">{{ $ad->title }}</a>
                                                                </h4>
                                                            </div>

                                                            <!-- Bid Statistics -->
                                                            <div
                                                                class="flex-wrap mb-2 d-flex justify-content-center mb-md-0">
                                                                <div class="mx-2 text-center">
                                                                    <p class="mb-1 text-muted">Total Bids</p>
                                                                    <strong
                                                                        class="d-block">{{ $ad->bids->count() }}</strong>
                                                                </div>
                                                                <div class="mx-2 text-center">
                                                                    <p class="mb-1 text-muted">Rejected Bids</p>
                                                                    <strong
                                                                        class="d-block text-danger">{{ $ad->bids->where('status', 'rejected')->count() }}</strong>
                                                                </div>
                                                                <div class="mx-2 text-center">
                                                                    <p class="mb-1 text-muted">Pending Bids</p>
                                                                    <strong
                                                                        class="d-block text-warning">{{ $ad->bids->where('status', 'pending')->count() }}</strong>
                                                                </div>
                                                            </div>

                                                            <!-- View Bids Button -->
                                                            <div class="text-center button">
                                                                <button type="button" class="btn btn-primary btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#bidsModal-{{ $ad->id }}">
                                                                    View Bids
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="bidsModal-{{ $ad->id }}" tabindex="-1"
                                                    aria-labelledby="bidsModalLabel-{{ $ad->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="bidsModalLabel-{{ $ad->id }}">Bids for:
                                                                    {{ $ad->title }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table id="dataTables" class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Bidder</th>
                                                                            <th>Offer</th>
                                                                            <th>Status</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($ad->bids as $bid)
                                                                            <tr>
                                                                                <td>{{ $bid->user->first_name }}
                                                                                    {{ $bid->user->last_name }}</td>
                                                                                <td>{{ $bid->offer }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($bid->status === 'accepted')
                                                                                        <span
                                                                                            class="badge bg-success">Accepted</span>
                                                                                    @elseif($bid->status === 'rejected')
                                                                                        <span
                                                                                            class="badge bg-danger">Rejected</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge bg-warning text-dark">Pending</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if ($bid->status === 'pending')
                                                                                        <form
                                                                                            action="{{ route('bids.accept', $bid->id) }}"
                                                                                            method="POST" class="d-inline">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="btn btn-success btn-sm">Accept</button>
                                                                                        </form>
                                                                                        <form
                                                                                            action="{{ route('bids.reject', $bid->id) }}"
                                                                                            method="POST" class="d-inline">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="btn btn-danger btn-sm">Reject</button>
                                                                                        </form>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
