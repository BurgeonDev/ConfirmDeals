@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Confirm Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <i>Checkouti>
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
                        <h1>Confirm Checkout</h1>
                        <h2>Confirm to proceed.</h2>

                        <div class="mt-4 button">

                            <form action="{{ $transactionUrl1 }}" method="POST">
                                @foreach ($postData as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <button style="border:none" type="submit"><a class="btn">Pay Now</a></button>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
