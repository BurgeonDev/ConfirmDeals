@extends('frontend.layouts.app')
@section('content')
    <!-- Start Hero Area -->
    @include('frontend.home.hero')
    <!-- End Hero Area -->

    <!-- Start Categories Area -->
    @include('frontend.Home.category')
    <!-- /End Categories Area -->

    <!-- Start Items Grid Area -->
    @include('frontend.Home.item')
    <!-- /End Items Grid Area -->

    <!-- Start Why Choose Area -->
    @include('frontend.Home.whyUs')
    <!-- /End Why Choose Area -->


    <!-- Start Call Action Area/ post ad -->
    @include('frontend.Home.adCall')
    <!-- End Call Action Area -->

    <!-- Start Ads Area -->
    @include('frontend.Home.ads')
    <!-- End Items Tab Area -->

    <!-- Start Pricing Table Area -->
    @include('frontend.Home.pricing')
    <!--/ End Pricing Table Area -->

    <!-- Start How Works Area -->
    @include('frontend.Home.howWork')
    <!-- End How Works Area -->
@endsection
