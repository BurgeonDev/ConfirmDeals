<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mail Success - ConfirmDeals</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.svg">
    <!-- Place favicon.ico in the root directory -->

    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&amp;display=swap" rel="stylesheet">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/LineIcons.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">

</head>

<body cz-shortcut-listen="true">

    <!-- Preloader -->
    <div class="preloader" style="opacity: 0; display: none;">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Error Area -->
    <div class="maill-success">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="success-content">
                        <h1>@lang('messages.congratulations')</h1>
                        <h2>@lang('messages.bid_placed_successfully')</h2>
                        <p>@lang('messages.bid_thank_you')</p>
                        <div class="button">
                            <a href="{{ route('home') }}" class="btn">@lang('messages.go_to_home')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Error Area -->

    <!-- ========================= JS here ========================= -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/glightbox.min.js"></script>
    <script>
        window.onload = function() {
            window.setTimeout(fadeout, 500);
        }

        function fadeout() {
            document.querySelector('.preloader').style.opacity = '0';
            document.querySelector('.preloader').style.display = 'none';
        }
    </script>


    <div id="veepn-breach-alert"></div>
    <style>
        @font-face {
            font-family: FigtreeVF;
            src: url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2 supports variations"), url(chrome-extension://majdfhpaihoncoakbjgbdhglocklcgno/fonts/FigtreeVF.woff2) format("woff2-variations");
            font-weight: 100 1000;
            font-display: swap
        }
    </style>
</body>

</html>
