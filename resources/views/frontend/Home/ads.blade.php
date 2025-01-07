<section class="items-tab section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        @lang('messages.trending_ads_title')
                    </h2>
                    {{-- <p class="wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                        @lang('messages.trending_ads_description')
                    </p> --}}
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-latest-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-latest" type="button" role="tab" aria-controls="nav-latest"
                            aria-selected="true">Service Ads</button>
                        <button class="nav-link" id="nav-popular-tab" data-bs-toggle="tab" data-bs-target="#nav-popular"
                            type="button" role="tab" aria-controls="nav-popular" aria-selected="false">Product
                            Ads</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-latest" role="tabpanel"
                        aria-labelledby="nav-latest-tab">
                        <div class="row">
                            @foreach ($serviceAds as $ad)
                                <div class="col-lg-3 col-md-4 col-12">
                                    <!-- Start Single Item -->
                                    <div class="single-item-grid">
                                        <div class="image">
                                            <img style="width: 100%; height: 250px; object-fit: cover;"
                                                src="{{ !empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0 ? asset('storage/' . $ad->pictures[0]) : asset('assets/images/default-image.jpg') }}"
                                                alt="{{ $ad->title }}">


                                            <i class="cross-badge lni lni-bolt"></i>

                                            @if ($ad->is_featured)
                                                <span class="flat-badge sale">Featured</span>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('ad.show', $ad->id) }}"
                                                class="tag">{{ $ad->category->name }}</a>
                                            <h3 class="title">
                                                <a href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                            </h3>
                                            <div class="user-rating">
                                                <div class="rating">
                                                    @php
                                                        $averageRating = $ad->user->feedbacks_avg_rating ?? 0; // Default to 0 if no rating
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($averageRating >= $i)
                                                            <i class="fa fa-star text-warning"></i>
                                                        @elseif ($averageRating >= $i - 0.5)
                                                            <i class="fa fa-star-half-alt text-warning"></i>
                                                        @else
                                                            <i class="fa fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                    <span>({{ number_format($averageRating, 1) }})</span>
                                                </div>
                                            </div>
                                            <p class="location">
                                                <a href="{{ route('ad.show', $ad->id) }}">
                                                    <i class="lni lni-map-marker"></i>
                                                    {{ $ad->city->name ?? 'Unknown City' }},
                                                    {{ $ad->country->name ?? 'Unknown Country' }}
                                                </a>
                                            </p>
                                            <ul class="info">
                                                <li class="price">PKR {{ number_format($ad->price, 1) }}</li>
                                                <li class="like">
                                                    <form action="{{ route('favorites.toggle') }}" method="POST"
                                                        class="favorite-form">
                                                        @csrf
                                                        <input type="hidden" name="ad_id"
                                                            value="{{ $ad->id }}">
                                                        <button type="submit" class="favorite-button">
                                                            <i
                                                                class="lni lni-heart {{ $ad->isFavoritedBy(auth()->user()) ? 'active' : '' }}"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-popular" role="tabpanel" aria-labelledby="nav-popular-tab">
                        <div class="row">
                            @foreach ($productAds as $ad)
                                <div class="col-lg-3 col-md-4 col-12">
                                    <!-- Start Single Item -->
                                    <div class="single-item-grid">
                                        <div class="image">
                                            <a href="{{ route('ad.show', $ad->id) }}">
                                                <img style="width: 100%; height: 250px; object-fit: cover;"
                                                    src="{{ !empty($ad->pictures) && is_array($ad->pictures) && count($ad->pictures) > 0 ? asset('storage/' . $ad->pictures[0]) : asset('assets/images/default-image.jpg') }}"
                                                    alt="{{ $ad->title }}">
                                                {{-- <img style="width: 100%; height: 250px; object-fit: cover;"
                                                    src="{{ isset($ad->pictures[0]) ? asset('storage/' . $ad->pictures[0]) : asset('assets/images/default-image.jpg') }}"
                                                    alt="{{ $ad->title }}"> --}}

                                            </a>

                                            <i class="cross-badge lni lni-bolt"></i>

                                            @if ($ad->is_featured)
                                                <span class="flat-badge sale">Featured</span>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('ad.show', $ad->id) }}"
                                                class="tag">{{ $ad->category->name }}</a>
                                            <h3 class="title">
                                                <a href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                            </h3>
                                            <div class="user-rating">
                                                <div class="rating">
                                                    @php
                                                        $averageRating = $ad->user->feedbacks_avg_rating ?? 0; // Default to 0 if no rating
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($averageRating >= $i)
                                                            <i class="fa fa-star text-warning"></i>
                                                        @elseif ($averageRating >= $i - 0.5)
                                                            <i class="fa fa-star-half-alt text-warning"></i>
                                                        @else
                                                            <i class="fa fa-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                    <span>({{ number_format($averageRating, 1) }})</span>
                                                </div>
                                            </div>
                                            <p class="location">
                                                <a href="{{ route('ad.show', $ad->id) }}">
                                                    <i class="lni lni-map-marker"></i>
                                                    {{ $ad->city->name ?? 'Unknown City' }},
                                                    {{ $ad->country->name ?? 'Unknown Country' }}
                                                </a>
                                            </p>
                                            <ul class="info">
                                                <li class="price">PKR {{ number_format($ad->price) }}</li>
                                                <li class="like">
                                                    <form action="{{ route('favorites.toggle') }}" method="POST"
                                                        class="favorite-form">
                                                        @csrf
                                                        <input type="hidden" name="ad_id"
                                                            value="{{ $ad->id }}">
                                                        <button type="submit" class="favorite-button">
                                                            <i
                                                                class="lni lni-heart {{ $ad->isFavoritedBy(auth()->user()) ? 'active' : '' }}"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            @endforeach
                        </div>

                    </div>
                    <div class="button header-button"
                        style="display: flex; justify-content: center; align-items: center; padding-top:10px;">
                        <a href="{{ route('categories.cat') }}" class="btn">See All Ads</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
