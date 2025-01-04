 <section class="hero-area overlay">
     <div class="container">
         <div class="row">
             <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                 <div class="text-center hero-text">
                     <!-- Start Hero Text -->
                     <div class="section-heading">
                         <h2 class="wow fadeInUp" data-wow-delay=".3s"
                             style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Welcome
                             to ConfirmDeals</h2>
                         <p class="wow fadeInUp" data-wow-delay=".5s"
                             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">You will find
                             confirm deals here which are verified by us.</p>
                     </div>
                     <section class="how-worked sections">
                         <div class="container">
                             {{-- <div class="row">
                                 <div class="col-12">
                                     <div class="section-title">
                                         <h2 class="wow fadeInUp" data-wow-delay=".4s"
                                             style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                             How It Works
                                         </h2>
                                     </div>
                                 </div>
                             </div> --}}
                             <div class="row">
                                 <div class="col-lg-3 col-md-6 col-12">
                                     <div class="single-work wow fadeInUp" data-wow-delay=".2s"
                                         style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                         <span class="serial">01</span>
                                         <h3>Create Account</h3>
                                         <p>Sign up to access personalized features whether you’re buying or selling.
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6 col-12">
                                     <div class="single-work wow fadeInUp" data-wow-delay=".4s"
                                         style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                         <span class="serial">02</span>
                                         <h3>Post or Search Ads</h3>
                                         <p>Sellers can post ads using coins, while buyers can search for existing ads.
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6 col-12">
                                     <div class="single-work wow fadeInUp" data-wow-delay=".6s"
                                         style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                         <span class="serial">03</span>
                                         <h3>Make Ads Offers</h3>
                                         <p>Buyers make offers on ads, and sellers receive and review offers.</p>
                                     </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6 col-12">
                                     <div class="single-work wow fadeInUp" data-wow-delay=".8s"
                                         style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                         <span class="serial">04</span>
                                         <h3>Finalize the Deal</h3>
                                         <p>If an offer is accepted, we help both parties proceed smoothly in this
                                             platform.</p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </section>

                     <!-- Updated Search Form -->
                     <div class="search-form wow fadeInUp" data-wow-delay=".7s"
                         style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">

                         <form method="GET" action="{{ route('categoriess') }}" class="row">
                             <div class="p-0 col-lg-4 col-md-4 col-12">
                                 <div class="search-input">
                                     <label for="keyword"><i class="lni lni-search-alt theme-color"></i></label>

                                     <input type="text" name="search" id="keyword" placeholder="Product keyword"
                                         value="{{ request('search') }}">
                                 </div>
                             </div>

                             <div class="p-0 col-lg-3 col-md-3 col-12">
                                 <div class="search-input">
                                     <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
                                     <select name="category" id="category">
                                         <option value="none" selected="" disabled="">Categories</option>
                                         @foreach ($categories as $category)
                                             <option value="{{ $category->id }}"
                                                 {{ request('category') == $category->id ? 'selected' : '' }}>
                                                 {{ $category->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="p-0 col-lg-3 col-md-3 col-12">
                                 <div class="search-input">
                                     <label for="city"><i class="lni lni-map-marker theme-color"></i></label>
                                     <select name="city" id="city">
                                         <option value="none" selected="" disabled="">Locations</option>
                                         @foreach ($cities as $city)
                                             <option value="{{ $city->name }}"
                                                 {{ request('city') == $city->name ? 'selected' : '' }}>
                                                 {{ $city->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="p-0 col-lg-2 col-md-2 col-12">
                                 <div class="search-btn button">
                                     <button type="submit" class="btn">
                                         <i class="lni lni-search-alt"></i> Search
                                     </button>
                                 </div>
                             </div>
                         </form>
                     </div>

                     <!-- End Search Form -->
                 </div>
             </div>
         </div>
     </div>
 </section>
