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
