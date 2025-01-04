<footer class="footer">
    <!-- Start Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer f-link">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{ route('about') }}">About</a></li>
                            {{-- <li><a href="{{ route('home') }}">How It's Works</a></li> --}}
                            <li><a href="{{ route('faq') }}">FAQ</a></li>
                            {{-- <li><a href="{{ route('pricing') }}">Pricing</a></li> --}}
                            <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer f-contact">
                        <h3>Contact</h3>
                        <ul>
                            <li>The Binary, Business Bay<br> Dubai</li>
                            <li>Mail: info@confirmdeals.com</li>
                        </ul>
                    </div>
                </div>

                <!-- Map Image -->
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="single-footer f-map">
                        {{-- <h3>Our Location</h3> --}}
                        <img src="{{ asset('frontend/assets/images/newsletter/map.jpeg') }}" alt="Map Location"
                            class="img-fluid"
                            style="border-radius: 8px; width: 100%; height: 200px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
