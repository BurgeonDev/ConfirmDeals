@extends('frontend.layouts.app')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">About Us</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="about-us section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="content-left wow fadeInLeft" data-wow-delay=".3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                        <img src="{{ asset('frontend/assets/images/about/choose-left.jpg') }}" alt="#">
                        <a href="https://www.youtube.com/watch?v=r44RKWyfcFw&amp;fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM"
                            class="glightbox video"><i class="lni lni-play"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- content-1 start -->
                    <div class="content-right wow fadeInRight" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInRight;">
                        <!-- Heading -->
                        <span class="sub-heading">@lang('messages.about')</span>
                        <h2>
                            {{-- <h1>@lang('messages.welcome')</h1> --}}
                            @lang('messages.about_our_company')
                        </h2>
                        <p>@lang('messages.about_description')</p>
                        <h3>@lang('messages.what_we_do')</h3>
                        <p>@lang('messages.what_we_do_description')</p>
                        <!-- End Heading -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
