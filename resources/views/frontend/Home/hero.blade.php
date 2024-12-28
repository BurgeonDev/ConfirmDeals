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
                             style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">Buy And
                             Sell Everything From Used Cars To Mobile Phones And <br>Computers,
                             Or Search For Property, Jobs And More.</p>
                     </div>
                     <!-- End Search Form -->
                     <!-- Start Search Form -->
                     <!-- Updated Search Form -->
                     <div class="search-form wow fadeInUp" data-wow-delay=".7s"
                         style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                         <div class="row">
                             <div class="p-0 col-lg-4 col-md-4 col-12">
                                 <div class="search-input">
                                     <label for="keyword"><i class="lni lni-search-alt theme-color"></i></label>
                                     <input type="text" name="keyword" id="keyword" placeholder="Product keyword">
                                 </div>
                             </div>
                             <div class="p-0 col-lg-3 col-md-3 col-12">
                                 <div class="search-input">
                                     <label for="category"><i class="lni lni-grid-alt theme-color"></i></label>
                                     <select name="category" id="category">
                                         <option value="none" selected="" disabled="">Categories</option>
                                         <?php foreach ($categories as $category): ?>
                                         <option value="<?php echo htmlspecialchars($category->id); ?>"><?php echo htmlspecialchars($category->name); ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="p-0 col-lg-3 col-md-3 col-12">
                                 <div class="search-input">
                                     <label for="city"><i class="lni lni-map-marker theme-color"></i></label>
                                     <select name="city" id="city">
                                         <option value="none" selected="" disabled="">Locations</option>
                                         <?php foreach ($cities as $city): ?>
                                         <option value="<?php echo htmlspecialchars($city->name); ?>"><?php echo htmlspecialchars($city->name); ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="p-0 col-lg-2 col-md-2 col-12">
                                 <div class="search-btn button">
                                     <button id="searchButton" class="btn"><i class="lni lni-search-alt"></i>
                                         Search</button>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <!-- End Search Form -->
                 </div>
             </div>
         </div>
     </div>
 </section>
 <script>
     document.addEventListener("DOMContentLoaded", () => {
         const searchButton = document.getElementById("searchButton");
         searchButton.addEventListener("click", () => {
             const keyword = document.getElementById("keyword").value;
             const category = document.getElementById("category").value;
             const city = document.getElementById("city").value;

             // Construct the URL with query parameters
             let url = "/category"; // Replace this with your category page URL
             const params = [];

             if (keyword) {
                 params.push(`keyword=${encodeURIComponent(keyword)}`);
             }
             if (category && category !== "none") {
                 params.push(`category=${encodeURIComponent(category)}`);
             }
             if (city && city !== "none") {
                 params.push(`city=${encodeURIComponent(city)}`);
             }

             if (params.length > 0) {
                 url += '?' + params.join('&');
             }

             // Redirect to the new URL with query parameters
             window.location.href = url;
         });
     });
 </script>
