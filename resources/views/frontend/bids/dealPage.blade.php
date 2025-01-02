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
    <div class="py-3 breadcrumbs bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0 page-title">Bids on Your Ads</h1>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="mb-0 breadcrumb-nav list-inline">
                        <li class="list-inline-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="list-inline-item active">Bids on Your Ads</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5 dashboard section">
        <div class="container">
            <div class="row">
                @include('frontend.dashboard.index')
                <div class="col-lg-9">
                    <div class="main-content">
                        <div class="p-4 bg-white rounded shadow-sm dashboard-block">
                            <h2 class="section-title">Deal Page</h2>
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
                                                    @if (
                                                        ($bid->user_paid == 0 && Auth::id() == $bid->user_id) ||
                                                            ($bid->seller_paid == 0 && Auth::id() == $bid->ad->user_id))
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
    </section>
@endsection
