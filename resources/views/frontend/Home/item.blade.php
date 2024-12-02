<section class="items-grid section custom-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Latest
                        Products</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Discover our
                        latest arrivals! Browse through a wide variety of top-quality products carefully curated to meet
                        your needs and preferences.
                    </p>
                </div>
            </div>
        </div>
        <div class="single-head">
            <div class="row">
                @foreach ($latestAds as $ad)
                    <!-- Loop through each ad -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single Grid -->
                        <div class="single-grid wow fadeInUp" data-wow-delay=".2s"
                            style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="image">
                                <a href="{{ route('ad.show', $ad->id) }}" class="thumbnail">
                                    <img style="width: 450px; height: 350px; object-fit: cover;"
                                        src="{{ asset('storage/' . $ad->pictures[0]) }}" alt="{{ $ad->title }}">
                                </a>
                                <div class="author">
                                    <div class="author-image">
                                        <a href="javascript:void(0)">
                                            @if ($ad->user && $ad->user->profile_pic)
                                                <!-- Display user's avatar if it exists -->
                                                <img src="{{ asset('storage/' . $ad->user->profile_pic) }}"
                                                    alt="User pic">
                                            @else
                                                <!-- Display default image if user has no avatar -->
                                                <img src="{{ asset('frontend/assets/images/user/user.png') }}"
                                                    alt="Default User Avatar">
                                            @endif

                                            <span>{{ $ad->user->first_name ?? 'Unknown' }}
                                                {{ $ad->user->last_name }}</span>
                                        </a>
                                    </div>
                                    <p class="sale">For Sale</p>
                                </div>

                            </div>
                            <div class="content">
                                <div class="top-content">
                                    <a href="javascript:void(0)"
                                        class="tag">{{ $ad->category->name ?? 'Uncategorized' }}</a>
                                    <h3 class="title">
                                        <a href="{{ route('ad.show', $ad->id) }}">{{ $ad->title }}</a>
                                    </h3>
                                    <p class="update-time">Last Updated: {{ $ad->updated_at->diffForHumans() }}</p>
                                    <ul class="rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            <li><i class="lni lni-star-filled"></i></li>
                                        @endfor
                                        <li><a href="javascript:void(0)">(35)</a></li>
                                    </ul>
                                    <ul class="info-list">
                                        <li><a href="javascript:void(0)"><i class="lni lni-map-marker"></i>
                                                {{ $ad->city->name ?? 'Unknown' }},
                                                {{ $ad->locality->name ?? 'Unknown' }}</a></li>
                                        <li><a href="javascript:void(0)"><i class="lni lni-timer"></i>
                                                {{ $ad->created_at->format('M d, Y') }}</a></li>
                                    </ul>
                                </div>
                                <div class="bottom-content">
                                    <p class="price">Start From: Pkr <span>{{ number_format($ad->price, 1) }}</span>
                                    </p>
                                    <li class="like">
                                        <form action="{{ route('favorites.toggle') }}" method="POST"
                                            class="favorite-form">
                                            @csrf
                                            <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                            <button type="submit" class="favorite-button">
                                                <i
                                                    class="lni lni-heart {{ $ad->isFavoritedBy(auth()->user()) ? 'active' : '' }}"></i>
                                            </button>
                                        </form>
                                    </li>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Grid -->
                    </div>
                @endforeach
            </div>
            <div class="button header-button"
                style="display: flex; justify-content: center; align-items: center; padding-top:10px;">
                <a href="{{ route('categories.cat') }}" class="btn">See All Products</a>
            </div>
        </div>
    </div>
</section>
