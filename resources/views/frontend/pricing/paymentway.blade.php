@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Payment</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Payment Options Area -->
    <div class="maill-success">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="success-content">
                        <h1>Choose Payment Method</h1>
                        <h2>Select one of the payment options below to proceed.</h2>

                        <h1>Payment Details</h1>


                        <div class="mt-4 button">
                            <form action="{{ route('jazzcash') }}" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{$price}}">
                                <input type="hidden" name="packageName" value="{{ $packageName }}" >
                                <button style="border:none" type="submit"><a class="btn">Pay with JazzCash</a></button>
                            </form>
                        </div>
                        <div class="mt-4 button">
                            <form action="{{ route('easypaisa') }}" method="POST">
                                @csrf
                                <input type="hidden" name="amount" value="{{$price}}">
                                <input type="hidden" name="packageName" value="{{ $packageName }}" >
                                <button style="border:none" type="submit"><a class="btn">Pay with Easypaisa</a></button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
