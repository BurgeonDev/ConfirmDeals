{{-- @extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">My Transactions</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Transactions</li>
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
                            <h3 class="block-title">Invoice</h3>
                            <!-- Start Invoice Items Area -->
                            <div class="invoice-items default-list-style">
                                <!-- Start List Title -->
                                <div class="default-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <p>Package</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Payment</p>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <p>Reference</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Status</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12 align-right">
                                            <p>Date</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->

                                <!-- Start Single List -->
                                @foreach ($transactions as $transaction)
                                    <div class="single-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <p>{{ $transaction->package_name }}
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <span>PKR {{ $transaction->payment }}</span>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <p>{{ $transaction->transaction_reference }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p class="{{ strtolower($transaction->status) }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12 align-right">
                                                <p>{{ $transaction->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End Single List -->


                            </div>
                            <!-- End Invoice Items Area -->
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
                        <h1 class="page-title">My Transactions</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>My Transactions</li>
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
                            <h3 class="block-title">Invoice</h3>
                            <!-- Start Invoice Items Area -->
                            <div class="invoice-items default-list-style">
                                <!-- Start List Title -->
                                <div class="default-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-3 col-md-3 col-12">
                                            <p>Package</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Payment</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Reference</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Status</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Date</p>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-12 align-right">
                                            <p>Action</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->

                                <!-- Start Single List -->
                                @foreach ($transactions as $transaction)
                                    <div class="single-list">
                                        <div class="row align-items-center">
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <p>{{ $transaction->package_name }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <span>PKR {{ $transaction->payment }}</span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ $transaction->transaction_reference }}</p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p class="{{ strtolower($transaction->status) }}">
                                                    {{ ucfirst($transaction->status) }}
                                                </p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-12">
                                                <p>{{ $transaction->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-12 align-right">

                                                <a>
                                                    <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            style="border: none; background: none; color:red">
                                                            <i class="lni lni-trash"></i>
                                                        </button>
                                                    </form>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- End Single List -->
                            </div>
                            <!-- End Invoice Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
