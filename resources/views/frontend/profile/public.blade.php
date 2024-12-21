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
                                    <!-- Ad Details -->
                                    <a href="{{ route('ad.show', $ad->id) }}">
                                        <h4 class="h5 fw-bold" style="color: #582fe0">{{ $ad->title }}</h4>
                                    </a>

                                    <!-- Feedback Section -->
                                    <h5 class="mt-3 h6 text-dark">Feedbacks:</h5>
                                    <ul class="list-unstyled">
                                        @forelse ($ad->feedbacks as $feedback)
                                            <li class="mb-3">
                                                <!-- Feedback from User -->
                                                <strong class="text-primary">{{ $feedback->user->first_name }}
                                                    {{ $feedback->user->last_name }}</strong>
                                                <span class="text-muted small">Rated:
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </span>
                                                <span class="text-muted small" style="float: right;">
                                                    {{ \Carbon\Carbon::parse($feedback->created_at)->diffForHumans() }}
                                                </span>
                                                <p class="mb-1 text-muted" style="padding-left: 3%">
                                                    {{ $feedback->comment }}
                                                </p>

                                            </li>

                                            <li> <!-- Owner's response -->
                                                @if ($feedback->response)
                                                    <strong class="text-primary">{{ $user->first_name }}
                                                        {{ $user->last_name }}</strong><br>
                                                    <span
                                                        class="text-muted"style="padding-left: 3%">{{ $feedback->response }}</span>
                                                    <!-- Response form for the owner only -->
                                                @else
                                                    @if (auth()->id() === $ad->user_id)
                                                        <p class="mt-2">

                                                            <a class="reply"
                                                                style="padding: 8px 15px; border: 1px solid #5930e0; color: #888; border-radius: 4px; margin-top: 20px; font-size: 14px; font-weight: 500;"><i
                                                                    class="lni lni-reply" style="color: #582fe0"></i>
                                                                <button style="color: #582fe0" class="p-0 btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#responseModal-{{ $feedback->id }}">Reply</button>
                                                            </a>


                                                        </p>

                                                        <!-- Modal for Response -->
                                                        <div class="modal fade" id="responseModal-{{ $feedback->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="responseModalLabel-{{ $feedback->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="responseModalLabel-{{ $feedback->id }}">
                                                                            Respond
                                                                            to Feedback</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('feedback.response', $feedback->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="response-{{ $feedback->id }}"
                                                                                    class="form-label">Your Response</label>
                                                                                <textarea class="form-control" id="response-{{ $feedback->id }}" name="response" rows="3" required></textarea>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-light"
                                                                                style="color: #582fe0">Submit
                                                                                Response</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
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
