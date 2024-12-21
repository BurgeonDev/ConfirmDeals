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
    <h1>Confirm Payment</h1>
    <form action="{{ $transactionUrl2 }}" method="POST">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="postBackURL" value="{{ $postBackURL }}">
        <button type="submit">Confirm Payment</button>
    </form>
@endsection
