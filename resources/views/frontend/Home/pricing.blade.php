<section class="pricing-table section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        Coin Pricing Plan
                    </h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                        Affordable coin packages designed to boost your ad reach and visibility, tailored for every
                        budget
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($coins as $coin)
                <!-- First Pricing Table (50 Coins) -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="table-head">
                            <div class="price">
                                <h5 class="amount">PKR {{ number_format($coin->price_in_pkr * 50, 0) }}</h5>
                            </div>
                            <h4 class="title">50 Coins</h4>
                        </div>
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> 50</li>
                            <li><strong> Ad Postings:</strong> Multiple non-featured ads</li>
                            <li><strong> Visibility:</strong> Higher visibility than Free plan</li>
                            <li><strong> Promotional Tools:</strong> Basic promotional tools to attract views</li>
                        </ul>
                        <form action="{{ route('paymentsway') }}">
                            @csrf
                            {{-- <input type="hidden" name="coins_quantity" value="50"> --}}
                            <input type="hidden" name="price" value="{{ $coin->price_in_pkr * 50 }}">
                            <input type="hidden" name="packageName" value="50 Coins Package">
                            <div class="button">
                                <button style="border:none" class="btn" type="submit">Buy Now</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Second Pricing Table (100 Coins) -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <div class="table-head">
                            <div class="price">
                                <h5 class="amount">PKR {{ number_format($coin->price_in_pkr * 100, 0) }}</h5>
                            </div>
                            <h4 class="title">100 Coins</h4>
                        </div>
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> 100</li>
                            <li><strong> Ad Postings:</strong> Multiple non-featured ads</li>
                            <li><strong> Visibility:</strong> Higher visibility than Free plan</li>
                            <li><strong> Promotional Tools:</strong> Basic promotional tools to attract views</li>
                        </ul>
                        <form action="{{ route('paymentsway') }}">
                            @csrf
                            {{-- <input type="hidden" name="coins_quantity" value="100"> --}}
                            <input type="hidden" name="price" value="{{ $coin->price_in_pkr * 100 }}">
                            <input type="hidden" name="packageName" value="100 Coins Package">
                            <div class="button">
                                <button style="border:none" class="btn" type="submit">Buy Now</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Third Pricing Table (Custom User Input) -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-table wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                        <div class="table-head">
                            <div class="price">
                                <h5 class="amount">PKR <span id="total_price">0</span></h5>
                            </div>
                            <h4 class="title">Custom Coins</h4>
                        </div>
                        <ul class="table-list">
                            <li><strong> Coins: <i style="color: goldenrod" class="fas fa-coins"></i></strong> Custom
                            </li>
                            <li><strong> Ad Postings:</strong> Custom number of ads based on the coins</li>
                        </ul>
                        <form action="{{ route('paymentsway') }}">
                            @csrf
                            <div class="form-group">
                                <label for="coins_quantity">Enter the number of coins:</label>
                                <input type="number" id="coins_quantity" class="form-control" value="1"
                                    min="1" required>
                            </div>
                            <input type="hidden" name="price" id="price" value="{{ $coin->price_in_pkr }}">
                            <input type="hidden" name="packageName" value="Custom Coins">
                            <div class="button">
                                <button style="border:none" class="btn" type="submit">Buy Now</button>
                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const coinsQuantityInput = document.getElementById('coins_quantity');
                                const priceInput = document.getElementById('price');
                                const totalPriceElement = document.getElementById('total_price');
                                const pricePerCoin = {{ $coin->price_in_pkr }};

                                function updateTotalPrice() {
                                    const coinsQuantity = parseInt(coinsQuantityInput.value) ||
                                    1; // Default to 1 if input is empty or invalid
                                    const totalPrice = coinsQuantity * pricePerCoin;
                                    totalPriceElement.textContent = totalPrice.toFixed(0); // Update visible total price
                                    priceInput.value = totalPrice.toFixed(0); // Update hidden price input
                                }

                                // Add event listener for live updates
                                coinsQuantityInput.addEventListener('input', updateTotalPrice);

                                // Initialize total price on page load
                                updateTotalPrice();
                            });
                        </script>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
