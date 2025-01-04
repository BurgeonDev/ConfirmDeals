<section class="dashboard pricing-table section">
    <div class="container">
        <div class="row">
            @include('frontend.dashboard.index')
            <div class="col-lg-9 col-md-8 col-12">
                <div class="main-content">

                    <div class="mt-0 dashboard-block">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3 class="block-title">Coin Pricing</h3>
                        <div class="inner-block">
                            <div class="post-ad-tab">
                                <div class="step-one-content">
                                    <div class="row">
                                        @foreach ($coins as $coin)
                                            {{-- <div class="col-lg-4 col-md-6 col-12">
                                                <div class="single-table wow fadeInUp" data-wow-delay=".2s"
                                                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                    <div class="table-head">
                                                        <div class="price">
                                                            <h5 class="amount">PKR
                                                                {{ number_format($coin->price_in_pkr * 50, 0) }}</h5>
                                                        </div>
                                                        <h4 class="title">50 Coins</h4>
                                                    </div>
                                                    <ul class="table-list">
                                                        <li><strong> Coins: <i style="color: goldenrod"
                                                                    class="fas fa-coins"></i></strong> 50</li>
                                                        <li><strong> Ad Postings:</strong> Multiple non-featured ads
                                                        </li>
                                                        <li><strong> Visibility:</strong> Higher visibility than Free
                                                            plan</li>
                                                        <li><strong> Promotional Tools:</strong> Basic promotional tools
                                                            to attract views</li>
                                                    </ul>
                                                    <form action="{{ route('paymentsway') }}">
                                                        @csrf

                                                        <input type="hidden" name="price"
                                                            value="{{ $coin->price_in_pkr * 50 }}">
                                                        <input type="hidden" name="packageName"
                                                            value="50 Coins Package">
                                                        <div class="button">
                                                            <button style="border:none" class="btn"
                                                                type="submit">Buy Now</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div> --}}


                                            <!-- Third Pricing Table (Custom User Input) -->
                                            <div class="col-lg-12 col-md-12 col-12">
                                                <div class="single-table wow fadeInUp" data-wow-delay=".6s"
                                                    style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                                                    <div class="table-head">
                                                        <div class="price">
                                                            <h5 class="amount">PKR <span id="total_price">0</span></h5>
                                                        </div>
                                                        <h4 class="title">Custom Coins</h4>
                                                    </div>
                                                    <ul class="table-list">
                                                        <li><strong> Coins: <i style="color: goldenrod"
                                                                    class="fas fa-coins"></i></strong> Custom
                                                        </li>
                                                        <li><strong> Ad Postings:</strong> Custom number of ads based on
                                                            the coins</li>
                                                    </ul>
                                                    <form action="{{ route('paymentsway') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="coins_quantity">Enter the number of
                                                                coins:</label>
                                                            <input type="number" id="coins_quantity"
                                                                class="form-control" value="1" min="1"
                                                                required>
                                                        </div>
                                                        <input type="hidden" name="price" id="price"
                                                            value="{{ $coin->price_in_pkr }}">
                                                        <input type="hidden" name="packageName" value="Custom Coins">
                                                        <div class="button">
                                                            <button style="border:none" class="btn"
                                                                type="submit">Buy Now</button>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
