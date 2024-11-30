<section class="categories">
    <div class="container">
        <div class="cat-inner">
            <div class="row">
                <div class="p-0 col-12">
                    <div class="tns-outer" id="tns1-ow">
                        <div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button type="button"
                                data-controls="prev" tabindex="-1" aria-controls="tns1"><i
                                    class="lni lni-chevron-left"></i></button><button type="button"
                                data-controls="next" tabindex="-1" aria-controls="tns1"><i
                                    class="lni lni-chevron-right"></i></button></div>
                        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide
                            <span class="current">10 to 15</span> of 13
                        </div>
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div class="category-slider tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                    id="tns1"
                                    style="transition-duration: 0s; transform: translate3d(-29.0323%, 0px, 0px);">
                                    @foreach ($categories as $category)
                                        <a href="{{ route('categories.cat') }}" class="single-cat tns-item">
                                            <div class="icon">
                                                <!-- Display the category icon based on the mapping -->
                                                @if (isset($categoryIcons[$category->name]))
                                                    <i class="{{ $categoryIcons[$category->name] }}"
                                                        style="color: #582fe0"></i>
                                                @else
                                                    <!-- Fallback icon if the category name is not found in the mapping -->
                                                    <i class="fas fa-box" style="color: #582fe0;"></i>
                                                @endif
                                            </div>
                                            <h3>{{ $category->name }}</h3>
                                            <h5 class="total">{{ $category->ads->count() }}</h5>
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="categories">
    <div class="container">
        <div class="cat-inner">
            <div class="row">
                <div class="p-0 col-12">
                    <div class="tns-outer" id="tns1-ow">
                        <div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button type="button"
                                data-controls="prev" tabindex="-1" aria-controls="tns1"><i
                                    class="lni lni-chevron-left"></i></button><button type="button"
                                data-controls="next" tabindex="-1" aria-controls="tns1"><i
                                    class="lni lni-chevron-right"></i></button></div>
                        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide
                            <span class="current">14 to 19</span> of 13
                        </div>
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div class="category-slider tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                    id="tns1" style="transform: translate3d(-41.9355%, 0px, 0px);"><a
                                        href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/jobs.svg" alt="#">
                                        </div>
                                        <h3>Jobs</h3>
                                        <h5 class="total">44</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/real-estate.svg" alt="#">
                                        </div>
                                        <h3>Real Estate</h3>
                                        <h5 class="total">65</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/laptop.svg" alt="#">
                                        </div>
                                        <h3>Education</h3>
                                        <h5 class="total">35</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/hospital.svg" alt="#">
                                        </div>
                                        <h3>Health &amp; Beauty</h3>
                                        <h5 class="total">22</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/tshirt.svg" alt="#">
                                        </div>
                                        <h3>Fashion</h3>
                                        <h5 class="total">25</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/education.svg" alt="#">
                                        </div>
                                        <h3>Education</h3>
                                        <h5 class="total">42</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/controller.svg" alt="#">
                                        </div>
                                        <h3>Gadgets</h3>
                                        <h5 class="total">32</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/travel.svg" alt="#">
                                        </div>
                                        <h3>Backpacks</h3>
                                        <h5 class="total">15</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/watch.svg" alt="#">
                                        </div>
                                        <h3>Watches</h3>
                                        <h5 class="total">65</h5>
                                    </a>
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item0"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/car.svg" alt="#">
                                        </div>
                                        <h3>Vehicle</h3>
                                        <h5 class="total">35</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item1"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/laptop.svg" alt="#">
                                        </div>
                                        <h3>Electronics</h3>
                                        <h5 class="total">22</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item2"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/matrimony.svg" alt="#">
                                        </div>
                                        <h3>Matrimony</h3>
                                        <h5 class="total">55</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item3"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/furniture.svg" alt="#">
                                        </div>
                                        <h3>Furnitures</h3>
                                        <h5 class="total">21</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item4">
                                        <div class="icon">
                                            <img src="assets/images/categories/jobs.svg" alt="#">
                                        </div>
                                        <h3>Jobs</h3>
                                        <h5 class="total">44</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item5">
                                        <div class="icon">
                                            <img src="assets/images/categories/real-estate.svg" alt="#">
                                        </div>
                                        <h3>Real Estate</h3>
                                        <h5 class="total">65</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item6">
                                        <div class="icon">
                                            <img src="assets/images/categories/laptop.svg" alt="#">
                                        </div>
                                        <h3>Education</h3>
                                        <h5 class="total">35</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item7">
                                        <div class="icon">
                                            <img src="assets/images/categories/hospital.svg" alt="#">
                                        </div>
                                        <h3>Health &amp; Beauty</h3>
                                        <h5 class="total">22</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item8">
                                        <div class="icon">
                                            <img src="assets/images/categories/tshirt.svg" alt="#">
                                        </div>
                                        <h3>Fashion</h3>
                                        <h5 class="total">25</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-active"
                                        id="tns1-item9">
                                        <div class="icon">
                                            <img src="assets/images/categories/education.svg" alt="#">
                                        </div>
                                        <h3>Education</h3>
                                        <h5 class="total">42</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item10"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/controller.svg" alt="#">
                                        </div>
                                        <h3>Gadgets</h3>
                                        <h5 class="total">32</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item11"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/travel.svg" alt="#">
                                        </div>
                                        <h3>Backpacks</h3>
                                        <h5 class="total">15</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <!-- Start Single Category -->
                                    <a href="category.html" class="single-cat tns-item" id="tns1-item12"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/watch.svg" alt="#">
                                        </div>
                                        <h3>Watches</h3>
                                        <h5 class="total">65</h5>
                                    </a>
                                    <!-- End Single Category -->
                                    <a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/car.svg" alt="#">
                                        </div>
                                        <h3>Vehicle</h3>
                                        <h5 class="total">35</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/laptop.svg" alt="#">
                                        </div>
                                        <h3>Electronics</h3>
                                        <h5 class="total">22</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/matrimony.svg" alt="#">
                                        </div>
                                        <h3>Matrimony</h3>
                                        <h5 class="total">55</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/furniture.svg" alt="#">
                                        </div>
                                        <h3>Furnitures</h3>
                                        <h5 class="total">21</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/jobs.svg" alt="#">
                                        </div>
                                        <h3>Jobs</h3>
                                        <h5 class="total">44</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/real-estate.svg" alt="#">
                                        </div>
                                        <h3>Real Estate</h3>
                                        <h5 class="total">65</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/laptop.svg" alt="#">
                                        </div>
                                        <h3>Education</h3>
                                        <h5 class="total">35</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/hospital.svg" alt="#">
                                        </div>
                                        <h3>Health &amp; Beauty</h3>
                                        <h5 class="total">22</h5>
                                    </a><a href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="assets/images/categories/tshirt.svg" alt="#">
                                        </div>
                                        <h3>Fashion</h3>
                                        <h5 class="total">25</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
