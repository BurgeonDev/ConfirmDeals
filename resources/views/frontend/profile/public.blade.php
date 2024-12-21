@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ $user->first_name }} {{ $user->last_name }}'s Profile</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Section -->
    <section class="py-5 bg-white profile-section section">
        <div class="container">
            <div class="row g-4">
                <!-- Profile Card -->
                <div class="col-lg-4 col-md-5 col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="text-center card-body">
                            <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('frontend/assets/images/user/user.png') }}"
                                alt="User Image" class="mb-3 rounded-circle img-thumbnail"
                                style="width: 150px; height: 150px;">
                            <h2 class="h4 text-dark">{{ $user->first_name }} {{ $user->last_name }}</h2>
                            <div class="mt-2 rating">
                                @if ($averageRating)
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($averageRating >= $i)
                                            <i class="fa fa-star text-warning"></i>
                                        @elseif ($averageRating >= $i - 0.5)
                                            <i class="fa fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="fa fa-star text-muted"></i>
                                        @endif
                                    @endfor
                                    <span class="mt-1 d-block text-muted">({{ number_format($averageRating, 1) }})</span>
                                @else
                                    <p class="text-muted">No ratings yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ads List -->
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="border-0 shadow-sm card">
                        <div class="card-body">
                            <h3 class="mb-4">{{ $user->first_name }} {{ $user->last_name }}'s Ads</h3>
                            @forelse ($ads as $ad)
                                <div class="pb-3 mb-4 ad-card border-bottom">
                                    <!-- Ad Picture -->

                                    <!-- Ad Details -->
                                    <a href="{{ route('ad.show', $ad->id) }}">
                                        <h4 class="h5 fw-bold" style="color: #582fe0">{{ $ad->title }}</h4>
                                    </a>

                                    <h5 class="mt-3 h6 text-dark">Feedbacks:</h5>
                                    <ul class="list-unstyled">
                                        @forelse ($ad->feedbacks as $feedback)
                                            <li class="mb-3">
                                                <strong class="text-primary">{{ $feedback->user->first_name }}
                                                    {{ $feedback->user->last_name }}</strong>:<br>
                                                <span class="text-muted small">Rated
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </span>
                                                <p class="mb-1 text-muted">{{ $feedback->comment }}</p>
                                            </li>
                                        @empty
                                            <p class="text-muted">No feedback yet for this ad.</p>
                                        @endforelse
                                    </ul>
                                </div>
                            @empty
                                <p class="text-muted">No ads posted yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
