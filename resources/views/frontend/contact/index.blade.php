@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Contact Us</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="contact-us" class="contact-us section">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="contact-head wow fadeInUp" data-wow-delay=".4s"
                style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="single-head">
                            <div class="contant-inner-title">
                                <h2>@lang('messages.our_contacts_location')</h2>
                                <p>@lang('messages.contact_inquiries')</p>
                            </div>
                            <div class="single-info">
                                <h3>@lang('messages.opening_hours')</h3>
                                <ul>
                                    <li>@lang('messages.daily_hours')</li>
                                    <li>@lang('messages.sunday_closed')</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <h3>@lang('messages.contact_info')</h3>
                                <ul>
                                    <li>@lang('messages.address')</li>
                                    <li>@lang('messages.city_zip')</li>
                                    <li><a href="mailto:@lang('messages.email_address')">@lang('messages.email_address')</a></li>
                                    <li><a href="tel:@lang('messages.phone_number')">@lang('messages.phone_number')</a></li>
                                </ul>
                            </div>
                            <div class="single-info contact-social">
                                <h3>@lang('messages.social_contact')</h3>
                                <ul>
                                    <li><a href="javascript:void(0)"><i class="lni lni-facebook-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-linkedin-original"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="lni lni-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7 col-12">
                        <div class="form-main">
                            <div class="form-title">
                                <h2>@lang('messages.get_in_touch')</h2>
                                <p>@lang('messages.contact_description')</p>
                            </div>
                            <form class="form" action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <input name="name" type="text" id="name"
                                                placeholder="@lang('messages.your_name')" value="{{ old('name') }}" required>
                                            @error('name')
                                                <span style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <input name="email" type="email" id="email"
                                                placeholder="@lang('messages.your_email')" value="{{ old('email') }}" required>
                                            @error('email')
                                                <span style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <textarea name="message" id="message" placeholder="@lang('messages.your_message')" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <span style="color: red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn">@lang('messages.submit_message')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
