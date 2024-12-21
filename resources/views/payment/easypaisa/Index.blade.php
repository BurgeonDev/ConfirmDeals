@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="maill-success">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="success-content">
                        <h1>Checkout Form</h1>
                        <h2>Enter the Details below to Proceed</h2>

                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf

                            <input class="form-control" type="hidden" name="uid" value="{{ $uid }}">
                            <input class="form-control" type="hidden" name="transactionId" value="{{ $transactionId }}">
                            <div class="form-group">

                                <input class="form-control" type="number" name="mobileNo" placeholder="Enter Mobile No"
                                    required>
                            </div>
                            <div class="mt-4 form-group">
                                <input class="form-control" type="text" name="amount" id="amount"
                                    placeholder="Enter Amount" required>
                            </div>
                            <div class="mt-4 button">

                                <button style="border:none" type="submit"><a class="btn">Proceed</a></button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
