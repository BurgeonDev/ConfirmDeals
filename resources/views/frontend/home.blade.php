@extends('frontend.layouts.app')
@section('content')
    <!-- Start Hero Area -->
    @include('frontend.home.hero')
    <!-- End Hero Area -->
    <!-- Start How Works Area -->
    @include('frontend.home.howWork')
    <!-- End How Works Area -->
    <!-- Start Categories Area -->
    {{-- @include('frontend.home.category') --}}
    <!-- /End Categories Area -->

    <!-- Start Items Grid Area -->
    {{-- @include('frontend.home.item') --}}
    <!-- /End Items Grid Area -->

    <!-- Start Why Choose Area -->
    {{-- @include('frontend.home.whyUs') --}}
    <!-- /End Why Choose Area -->


    <!-- Start Call Action Area/ post ad -->
    {{-- @include('frontend.home.adCall') --}}
    <!-- End Call Action Area -->

    <!-- Start Ads Area -->
    @include('frontend.home.ads')
    <!-- End Items Tab Area -->

    <!-- Start Pricing Table Area -->
    {{-- @include('frontend.home.pricing') --}}
    <!--/ End Pricing Table Area -->
@endsection
