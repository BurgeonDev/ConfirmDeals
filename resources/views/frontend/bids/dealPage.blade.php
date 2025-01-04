{{-- @extends('frontend.layouts.app')
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

                            <h1>Deal Page</h1>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ad Title</th>
                                        <th>Bid Offer</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bids as $bid)
                                        <tr>
                                            <td>{{ $bid->ad->title }}</td>
                                            <td>{{ number_format($bid->offer, 2) }}</td>
                                            <td>
                                                <!-- Show pay button only if the current user hasn't paid yet -->
                                                @if (($bid->user_paid == 0 && Auth::id() == $bid->user_id) || ($bid->seller_paid == 0 && Auth::id() == $bid->ad->user_id))
                                                    <form action="{{ route('payment.pay', ['bidId' => $bid->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Pay 0.25%</button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success">Paid</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($bid->user_paid && $bid->seller_paid)
                                                    <!-- If both buyer and seller have paid, show their complete details -->
                                                    <div>
                                                        <strong>Buyer Details:</strong>
                                                        <p>Name: {{ $bid->user->first_name }} {{ $bid->user->last_name }}
                                                        </p>
                                                        <p>Email: {{ $bid->user->email }}</p>
                                                        <p>Phone: {{ $bid->user->phone_number }}</p>
                                                        <p>Address:
                                                            {{ $bid->user->country->name }},
                                                            {{ $bid->user->city->name }},
                                                            {{ $bid->user->locality->name }}
                                                        </p>
                                                        <strong>Seller Details:</strong>
                                                        <p>Name: {{ $bid->ad->user->first_name }}
                                                            {{ $bid->ad->user->last_name }}</p>
                                                        <p>Email: {{ $bid->ad->user->email }}</p>
                                                        <p>Phone: {{ $bid->ad->user->phone_number }}</p>
                                                        <p>Address:
                                                            {{ $bid->ad->user->country->name }},
                                                            {{ $bid->ad->user->city->name }},
                                                            {{ $bid->ad->user->locality->name }}

                                                        </p>
                                                    </div>
                                                @else
                                                    <span class="badge bg-{{ $bid->user_paid ? 'success' : 'secondary' }}">
                                                        {{ $bid->user_paid ? 'Buyer Paid' : 'Buyer Unpaid' }}
                                                    </span>
                                                    <span
                                                        class="badge bg-{{ $bid->seller_paid ? 'success' : 'secondary' }}">
                                                        {{ $bid->seller_paid ? 'Seller Paid' : 'Seller Unpaid' }}
                                                    </span>
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
        </div>
    </section>
@endsection --}}
@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Deals</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Deals</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- <section class="py-5 dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9">
                    <div class="main-content">
                        <div class="p-4 bg-white rounded shadow-sm dashboard-block">
                            <h3 class="block-title">Deal Page</h3>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Ad Title</th>
                                            <th>Bid Offer</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bids as $bid)
                                            <tr>
                                                <td>{{ $bid->ad->title }}</td>
                                                <td>${{ number_format($bid->offer, 2) }}</td>
                                                <td>
                                                    @if (($bid->user_paid == 0 && Auth::id() == $bid->user_id) || ($bid->seller_paid == 0 && Auth::id() == $bid->ad->user_id))
                                                        <form action="{{ route('payment.pay', ['bidId' => $bid->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary btn-sm">Pay
                                                                0.25%</button>
                                                        </form>
                                                    @else
                                                        <span class="badge bg-success">Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($bid->user_paid && $bid->seller_paid)
                                                        <div class="details">
                                                            <strong>Buyer Details:</strong>
                                                            <p class="mb-1">Name: {{ $bid->user->first_name }}
                                                                {{ $bid->user->last_name }}</p>
                                                            <p class="mb-1">Email: {{ $bid->user->email }}</p>
                                                            <p class="mb-1">Phone: {{ $bid->user->phone_number }}</p>
                                                            <p class="mb-1">Address: {{ $bid->user->country->name }},
                                                                {{ $bid->user->city->name }},
                                                                {{ $bid->user->locality->name }}</p>

                                                            <strong>Seller Details:</strong>
                                                            <p class="mb-1">Name: {{ $bid->ad->user->first_name }}
                                                                {{ $bid->ad->user->last_name }}</p>
                                                            <p class="mb-1">Email: {{ $bid->ad->user->email }}</p>
                                                            <p class="mb-1">Phone: {{ $bid->ad->user->phone_number }}</p>
                                                            <p class="mb-1">Address: {{ $bid->ad->user->country->name }},
                                                                {{ $bid->ad->user->city->name }},
                                                                {{ $bid->ad->user->locality->name }}</p>
                                                        </div>
                                                    @else
                                                        <span
                                                            class="badge bg-{{ $bid->user_paid ? 'success' : 'secondary' }}">
                                                            {{ $bid->user_paid ? 'Buyer Paid' : 'Buyer Unpaid' }}
                                                        </span>
                                                        <span
                                                            class="badge bg-{{ $bid->seller_paid ? 'success' : 'secondary' }}">
                                                            {{ $bid->seller_paid ? 'Seller Paid' : 'Seller Unpaid' }}
                                                        </span>
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
            </div>
        </div>
    </section> --}}
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        <div class="mt-0 dashboard-block">
                            <h3 class="block-title">Deal Page</h3>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <!-- Start Item List Title -->
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <p>Ad Title</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Bid Offer</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <p>Payment</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <p>Status</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->

                                <!-- Start Single List -->
                                @foreach ($bids as $bid)
                                    <div class="single-item-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-4 col-md-4 col-12">

                                                <div class="content">
                                                    <h5 style="color: #5830e0"> <a
                                                            href="{{ route('ad.show', $bid->ad_id) }}"
                                                            class="title">{{ $bid->ad->title }}
                                                        </a></h5>
                                                </div>

                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>PKR {{ number_format($bid->offer, 0) }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                @if (
                                                    ($bid->user_paid == 0 && Auth::id() == $bid->user_id) ||
                                                        ($bid->seller_paid == 0 && Auth::id() == $bid->ad->user_id))
                                                    <form action="{{ route('payment.pay', ['bidId' => $bid->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-0 form-group button">
                                                            <button type="submit" class="btnn">Pay
                                                                0.25%</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success">Paid</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-12">
                                                @if ($bid->user_paid && $bid->seller_paid)
                                                    @if (Auth::id() == $bid->user_id)
                                                        <!-- Show Seller Details to Buyer -->
                                                        <div class="details">
                                                            <strong>Seller Details:</strong>
                                                            <p class="mb-1">Name: {{ $bid->ad->user->first_name }}
                                                                {{ $bid->ad->user->last_name }}</p>
                                                            <p class="mb-1">Email: {{ $bid->ad->user->email }}</p>
                                                            <p class="mb-1">Phone: {{ $bid->ad->user->phone_number }}</p>
                                                            {{-- <p class="mb-1">Address: {{ $bid->ad->user->country->name }},
                                                                {{ $bid->ad->user->city->name }},
                                                                {{ $bid->ad->user->locality->name }}</p> --}}
                                                        </div>
                                                    @elseif (Auth::id() == $bid->ad->user_id)
                                                        <!-- Show Buyer Details to Seller -->
                                                        <div class="details">
                                                            <strong>Buyer Details:</strong>
                                                            <p class="mb-1">Name: {{ $bid->user->first_name }}
                                                                {{ $bid->user->last_name }}</p>
                                                            <p class="mb-1">Email: {{ $bid->user->email }}</p>
                                                            <p class="mb-1">Phone: {{ $bid->user->phone_number }}</p>
                                                            {{-- <p class="mb-1">Address: {{ $bid->user->country->name }},
                                                                {{ $bid->user->city->name }},
                                                                {{ $bid->user->locality->name }}</p> --}}
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="badge bg-{{ $bid->user_paid ? 'success' : 'secondary' }}">
                                                        {{ $bid->user_paid ? 'Buyer Paid' : 'Buyer Unpaid' }}
                                                    </span>
                                                    <span
                                                        class="badge bg-{{ $bid->seller_paid ? 'success' : 'secondary' }}">
                                                        {{ $bid->seller_paid ? 'Seller Paid' : 'Seller Unpaid' }}
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End Single List -->
                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
