@extends('frontend.layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">@lang('messages.faq_title')</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>@lang('messages.faq_title')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="faq section">
        <div class="container">
            <div class="accordion" id="accordionExample">
                @for ($i = 1; $i <= 13; $i++)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $i }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $i }}" aria-expanded="false"
                                aria-controls="collapse{{ $i }}">
                                <span>@lang('messages.faq_question_' . $i)</span>
                            </button>
                        </h2>
                        <div id="collapse{{ $i }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>@lang('messages.faq_answer_' . $i)</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
