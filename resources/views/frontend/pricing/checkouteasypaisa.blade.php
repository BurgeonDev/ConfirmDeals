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
                        <h1>Easypaisa Payment</h1>
                        <h2>Package Name: {{ $packageName }}</h2>
                        <h2>Package Price: {{ $productPrice }}</h2>

                        <div class="mt-4 button">    
                            <form action="https://easypaystg.easypaisa.com.pk/easypay/Index.jsf" method="post">
                                @foreach($postData as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <input type="submit" value="Proceed to Payment" class="button" />
                            </form>
                            
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
