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
                            <h4 class="my-4 text-center">My Bids</h4>
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs justify-content-center border-bottom-0" id="myBidsTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="px-4 py-2 nav-link active fw-bold rounded-top" id="pending-tab"
                                        data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending"
                                        aria-selected="true" style="color: #5830e0">
                                        Pending
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-4 py-2 nav-link fw-bold rounded-top" id="accepted-tab" data-bs-toggle="tab"
                                        href="#accepted" role="tab" aria-controls="accepted" aria-selected="false"
                                        style="color: #5830e0">
                                        Accepted
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="px-4 py-2 nav-link fw-bold rounded-top" id="rejected-tab" data-bs-toggle="tab"
                                        href="#rejected" role="tab" aria-controls="rejected" aria-selected="false"
                                        style="color: #5830e0">
                                        Rejected
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="p-4 border tab-content bg-light rounded-bottom" id="myBidsTabsContent">
                                <!-- Pending Bids -->
                                <div class="tab-pane fade show active" id="pending" role="tabpanel"
                                    aria-labelledby="pending-tab">
                                    @forelse ($pendingBids as $bid)
                                        <div class="my-3 shadow-sm card">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <!-- Ad Image -->
                                                @if (!empty($bid->ad->pictures) && is_array($bid->ad->pictures))
                                                    <img src="{{ asset('storage/' . $bid->ad->pictures[0]) }}"
                                                        alt="Ad Picture" class="img-thumbnail"
                                                        style="width: 75px; height: 75px;">
                                                @else
                                                    <span>No Picture</span>
                                                @endif

                                                <!-- Bid Details -->
                                                <div class="d-flex flex-column flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        <a href="{{ route('ad.show', $bid->ad->id) }}"
                                                            class="text-decoration-none"
                                                            style="color: #5830e0">{{ $bid->ad->title }}</a>
                                                    </h5>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0"><strong>Offer:</strong> {{ $bid->offer }}</p>
                                                        <p class="mb-0"><strong>Date:</strong>
                                                            {{ $bid->created_at->format('d M Y') }}</p>
                                                        <p class="mb-0"><strong>Status:</strong> <span
                                                                class="badge bg-warning text-dark">Pending</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No pending bids found.</p>
                                    @endforelse
                                    <div style="justify-content:center" class="pagination center">
                                        <ul class="pagination-list">
                                            @if ($pendingBids->onFirstPage())
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @else
                                                <li><a href="{{ $pendingBids->previousPageUrl() }}"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @endif

                                            @foreach ($pendingBids->getUrlRange(1, $pendingBids->lastPage()) as $page => $url)
                                                <li class="{{ $pendingBids->currentPage() == $page ? 'active' : '' }}">
                                                    <a href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            @if ($pendingBids->hasMorePages())
                                                <li><a href="{{ $pendingBids->nextPageUrl() }}"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @else
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <!-- Accepted Bids -->
                                <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                                    @forelse ($acceptedBids as $bid)
                                        <div class="my-3 shadow-sm card">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                @if (!empty($bid->ad->pictures) && is_array($bid->ad->pictures))
                                                    <img src="{{ asset('storage/' . $bid->ad->pictures[0]) }}"
                                                        alt="Ad Picture" class="img-thumbnail"
                                                        style="width: 75px; height: 75px;">
                                                @else
                                                    <span>No Picture</span>
                                                @endif

                                                <div class="d-flex flex-column flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        <a href="{{ route('ad.show', $bid->ad->id) }}"
                                                            class="text-decoration-none"
                                                            style="color: #5830e0">{{ $bid->ad->title }}</a>
                                                    </h5>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0"><strong>Offer:</strong> {{ $bid->offer }}</p>
                                                        <p class="mb-0"><strong>Date:</strong>
                                                            {{ $bid->created_at->format('d M Y') }}</p>
                                                        <p class="mb-0"><strong>Status:</strong> <span
                                                                class="badge bg-success">Accepted</span></p>
                                                    </div>

                                                    <div class="row">
                                                        <!-- Feedback Button -->
                                                        <div class="col-6">
                                                            <button class="mt-2 btn btn-primary w-100"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#feedbackModal-{{ $bid->id }}">
                                                                Give Feedback
                                                            </button>
                                                        </div>

                                                        <!-- Deals Button -->
                                                        <div class="col-6">
                                                            <a href="{{ route('deal.page') }}"
                                                                class="mt-2 btn btn-secondary w-100">
                                                                View Deal
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Feedback -->
                                        <div class="modal fade" id="feedbackModal-{{ $bid->id }}" tabindex="-1"
                                            aria-labelledby="feedbackModalLabel-{{ $bid->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="feedbackModalLabel-{{ $bid->id }}">Submit Feedback
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('feedback.store', $bid->ad->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="ad_id"
                                                                value="{{ $bid->ad->id }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}">

                                                            <div class="mb-3">
                                                                <label for="rating-{{ $bid->id }}"
                                                                    class="form-label">Rating</label>
                                                                <select class="form-select"
                                                                    id="rating-{{ $bid->id }}" name="rating"
                                                                    required>
                                                                    <option value="" disabled selected>Select a
                                                                        rating</option>
                                                                    <option value="1">1 - Poor</option>
                                                                    <option value="2">2 - Fair</option>
                                                                    <option value="3">3 - Good</option>
                                                                    <option value="4">4 - Very Good</option>
                                                                    <option value="5">5 - Excellent</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="comment-{{ $bid->id }}"
                                                                    class="form-label">Comments</label>
                                                                <textarea class="form-control" id="comment-{{ $bid->id }}" name="comment" rows="3" required></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit
                                                                Feedback</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <p class="text-center">No accepted bids found.</p>
                                    @endforelse
                                    <div style="justify-content:center" class="pagination center">
                                        <ul class="pagination-list">
                                            @if ($acceptedBids->onFirstPage())
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @else
                                                <li><a href="{{ $acceptedBids->previousPageUrl() }}"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @endif

                                            @foreach ($acceptedBids->getUrlRange(1, $acceptedBids->lastPage()) as $page => $url)
                                                <li class="{{ $acceptedBids->currentPage() == $page ? 'active' : '' }}">
                                                    <a href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            @if ($acceptedBids->hasMorePages())
                                                <li><a href="{{ $acceptedBids->nextPageUrl() }}"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @else
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                <!-- Rejected Bids -->
                                <div class="tab-pane fade" id="rejected" role="tabpanel"
                                    aria-labelledby="rejected-tab">
                                    @forelse ($rejectedBids as $bid)
                                        <div class="my-3 shadow-sm card">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                @if (!empty($bid->ad->pictures) && is_array($bid->ad->pictures))
                                                    <img src="{{ asset('storage/' . $bid->ad->pictures[0]) }}"
                                                        alt="Ad Picture" class="img-thumbnail"
                                                        style="width: 75px; height: 75px;">
                                                @else
                                                    <span>No Picture</span>
                                                @endif

                                                <div class="d-flex flex-column flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        <a href="{{ route('ad.show', $bid->ad->id) }}"
                                                            class="text-decoration-none"
                                                            style="color: #5830e0">{{ $bid->ad->title }}</a>
                                                    </h5>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0"><strong>Offer:</strong> {{ $bid->offer }}</p>
                                                        <p class="mb-0"><strong>Date:</strong>
                                                            {{ $bid->created_at->format('d M Y') }}</p>
                                                        <p class="mb-0"><strong>Status:</strong> <span
                                                                class="badge bg-danger">Rejected</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No rejected bids found.</p>
                                    @endforelse
                                    <div style="justify-content:center" class="pagination center">
                                        <ul class="pagination-list">
                                            @if ($rejectedBids->onFirstPage())
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @else
                                                <li><a href="{{ $rejectedBids->previousPageUrl() }}"><i
                                                            class="lni lni-chevron-left"></i></a></li>
                                            @endif

                                            @foreach ($rejectedBids->getUrlRange(1, $rejectedBids->lastPage()) as $page => $url)
                                                <li class="{{ $rejectedBids->currentPage() == $page ? 'active' : '' }}">
                                                    <a href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            @if ($rejectedBids->hasMorePages())
                                                <li><a href="{{ $rejectedBids->nextPageUrl() }}"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @else
                                                <li class="disabled"><a href="javascript:void(0)"><i
                                                            class="lni lni-chevron-right"></i></a></li>
                                            @endif
                                        </ul>
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
