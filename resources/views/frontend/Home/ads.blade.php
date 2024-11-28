<section class="items-tab section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Trending Ads
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Discover the Power
                        of Trending Ads – Stay Ahead of the Curve with the Latest, Most Engaging Ads that Capture
                        Attention and Drive Results!</p>
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
                                            <a href="{{ route('ad.show', $ad->id) }}">
                                                <img style="width: 300px; height: 250px; object-fit: cover;"
                                                    src="{{ asset('storage/' . $ad->pictures[0] ?? 'default.jpg') }}"
                                                    alt="#">
                                            </a>
                                            @if ($ad->is_verified)
                                                <i class="cross-badge lni lni-bolt"></i>
                                            @endif
                                            <span
                                                class="flat-badge sale">{{ $ad->is_verified ? 'Verified' : 'Sale' }}</span>
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('ad.show', $ad->id) }}"
                                                class="tag">{{ $ad->category->name }}</a>
                                            <h3 class="title">
                                                <a href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                            </h3>
                                            <p class="location">
                                                <a href="{{ route('ad.show', $ad->id) }}">
                                                    <i class="lni lni-map-marker"></i>
                                                    {{ $ad->city->name ?? 'Unknown City' }},
                                                    {{ $ad->country->name ?? 'Unknown Country' }}
                                                </a>
                                            </p>
                                            <ul class="info">
                                                <li class="price">PKR {{ number_format($ad->price, 2) }}</li>
                                                <li class="like">
                                                    <a href="{{ route('ad.show', $ad->id) }}">
                                                        <i class="lni lni-heart"></i>
                                                    </a>
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
                                                <img style="width: 300px; height: 250px; object-fit: cover;"
                                                    src="{{ asset('storage/' . $ad->pictures[0] ?? 'default.jpg') }}"
                                                    alt="#">
                                            </a>
                                            @if ($ad->is_verified)
                                                <i class="cross-badge lni lni-bolt"></i>
                                            @endif
                                            <span
                                                class="flat-badge sale">{{ $ad->is_verified ? 'Verified' : 'Sale' }}</span>
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('ad.show', $ad->id) }}"
                                                class="tag">{{ $ad->category->name }}</a>
                                            <h3 class="title">
                                                <a href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                            </h3>
                                            <p class="location">
                                                <a href="{{ route('ad.show', $ad->id) }}">
                                                    <i class="lni lni-map-marker"></i>
                                                    {{ $ad->city->name ?? 'Unknown City' }},
                                                    {{ $ad->country->name ?? 'Unknown Country' }}
                                                </a>
                                            </p>
                                            <ul class="info">
                                                <li class="price">PKR {{ number_format($ad->price, 2) }}</li>
                                                <li class="like">
                                                    <a href="{{ route('ad.show', $ad->id) }}">
                                                        <i class="lni lni-heart"></i>
                                                    </a>
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
