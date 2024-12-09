<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Confirm Deals</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.svg') }}" />
    <!-- Place favicon.ico in the root directory -->

    <!-- Web Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>



    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}" />
    <style>
        .notification-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #582fe0;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
        }

        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 350px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px;
            border-radius: 5px;
            display: none;
            /* Hidden by default */
        }

        .notification-dropdown a {
            display: block;

            color: #333;
            text-decoration: none;
        }

        .notification-dropdown a:hover {
            background-color: #f5f5f5;
        }



        .notification-dropdown {
            position: absolute;
            /* Adjust based on your layout */
            top: 100%;
            /* Position below the triggering element */
            right: 0;
            /* Align to the right */
            width: 300px;
            /* Set a fixed width */
            max-height: 200px;
            /* Limit the height of the dropdown */
            overflow-y: auto;
            /* Enable vertical scrolling */
            background-color: #fff;
            /* Background color */
            border: 1px solid #ccc;
            /* Border for visibility */
            border-radius: 4px;
            /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Subtle shadow */
            z-index: 1000;
            /* Ensure it appears above other elements */
            padding: 10px;
            /* Add padding */
        }

        .notification-content {
            display: flex;
            flex-direction: column;
            /* Arrange notifications vertically */
            gap: 10px;
            /* Add spacing between notifications */
        }
    </style>
</head>

<body>

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

    <!-- Start Header Area -->
    @include('frontend.layouts.nav')
    <!-- End Header Area -->

    <!-- Start Dashboard Section -->
    @yield('content')
    <!-- End Dashboard Section -->
    <!-- Start Newsletter Area -->
    <div class="newsletter section">
        <div class="container">
            <div class="inner-content">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="title">
                            <i class="lni lni-alarm"></i>
                            <h2>Newsletter</h2>
                            <p>We don't send spam so don't worry.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form">
                            <form action="#" method="get" target="_blank" class="newsletter-form">
                                <input name="EMAIL" placeholder="Your email address" type="email">
                                <div class="button">
                                    <button class="btn">Subscribe<span class="dir-part"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Newsletter Area -->
    <!-- Start Footer Area -->
    @include('frontend.layouts.footer')
    <!--/ End Footer Area -->
    <!-- ========================= scroll-top ========================= -->
    <a href="{{ route('home') }}" class="scroll-top btn-hover" style="display: none;">
        <i class="lni lni-chevron-up"></i>
    </a>

    <script>
        $(document).ready(function() {
            $('#dataTables').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "columnDefs": [{
                    "targets": [1], // Column index to make numeric if needed
                    "type": "num"
                }]
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var icon = document.getElementById('notificationIcon');
            var dropdown = document.getElementById('notificationDropdown');

            icon.addEventListener('click', function() {
                if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                    dropdown.style.display = 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    <!-- ========================= JS here ========================= -->


    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <script type="text/javascript">
        //========= Category Slider
        tns({
            container: '.category-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 2,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                },
                1170: {
                    items: 6,
                }
            }
        });
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
