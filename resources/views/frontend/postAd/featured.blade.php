@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Ads</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Ads</li>
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
                            <h3 class="block-title">My Featured Ads</h3>

                            <div class="my-items">
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <p>@lang('messages.ad_title')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>@lang('messages.category')</p>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-12">
                                            <p>@lang('messages.type')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>@lang('messages.status')</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12 align-right">
                                            <p>@lang('messages.action')</p>
                                        </div>
                                    </div>
                                </div>

                                @forelse ($ads as $ad)
                                    <div class="single-item-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="item-image">
                                                    @if (!empty($ad->pictures) && is_array($ad->pictures))
                                                        <img src="{{ asset('storage/' . $ad->pictures[0]) }}"
                                                            alt="Ad Picture" class="img-thumbnail"
                                                            style="width: 75px; height: 75px;">
                                                    @else
                                                        <span>No Picture</span>
                                                    @endif

                                                    <div class="content">
                                                        <h3 class="title">
                                                            <a
                                                                href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                                        </h3>
                                                        <span class="price">{{ number_format($ad->price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ $ad->category->name }}</p>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-12">
                                                <p>{{ $ad->type }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ \Carbon\Carbon::parse($ad->featured_until)->diffForHumans(now(), true) }}
                                                    left</p>
                                            </div>





                                            <div class="col-lg-2 col-md-2 col-12 align-right">
                                                <ul class="action-btn">
                                                    <li>
                                                        <!-- Edit Button (This triggers the modal) -->
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                                            Edit Featured Ad
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="editModal" tabindex="-1"
                                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Update
                                                                            Featured Ad</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form for updating featured ad -->
                                                                        <form
                                                                            action="{{ route('ad.updateFeature', $ad->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('POST')
                                                                            <div class="mb-3">
                                                                                <label for="featured_days"
                                                                                    class="form-label">Number of days to
                                                                                    feature this ad:</label>
                                                                                <p>{{ $ad->featured_until ? \Carbon\Carbon::parse($ad->featured_until)->diffForHumans(now(), true) . ' left' : '' }}
                                                                                </p>

                                                                                <input type="number" class="form-control"
                                                                                    name="featured_days" min="1"
                                                                                    value="{{ old('featured_days', $ad->featured_until ? \Carbon\Carbon::parse($ad->featured_until)->diffInDays(now()) : '') }}"
                                                                                    required>

                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Update Featured
                                                                                Ad</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No featured ads available.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection