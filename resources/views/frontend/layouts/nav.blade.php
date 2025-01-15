 <header class="header navbar-area">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-12">
                 <div class="nav-inner">
                     <nav class="navbar navbar-expand-lg">
                         <a class="navbar-brand" href="{{ route('home') }}">
                             <img src="{{ asset('frontend/assets/images/logo/Logo1.svg') }}" alt="Logo">
                         </a>
                         <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                             data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                             aria-expanded="false" aria-label="Toggle navigation">
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                             <span class="toggler-icon"></span>
                         </button>
                         <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                             <ul id="nav" class="navbar-nav ms-auto">
                                 <li class="nav-item">
                                     <a href="{{ route('home') }}" aria-label="Toggle navigation">Home</a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('categories.cat') }}" aria-label="Toggle navigation">All Ads</a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('about') }}" aria-label="Toggle navigation">About</a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('contact.index') }}" aria-label="Toggle navigation">Contact
                                         Us</a>
                                 </li>

                                 @can('Manage Admin Dashbaord')
                                     <li class="nav-item">
                                         <a href="{{ route('dashboard') }}" aria-label="Toggle navigation">Dashboard</a>
                                     </li>
                                 @endcan

                             </ul>
                         </div>

                         <div class="login-button">
                             <ul>
                                 @auth
                                     <li>
                                         <a>
                                             {{-- <div class="notification-icon">
                                                 <i class="lni lni-alarm" id="notificationIcon"></i>
                                                 @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                                     <span class="notification-count"
                                                         style="height: 15px; width: 15px; font-size: 10px; text-align: left;">
                                                         {{ auth()->user()->unreadNotifications->count() > 9 ? '9' : auth()->user()->unreadNotifications->count() }}
                                                     </span>

                                                     <div class="notification-dropdown" id="notificationDropdown"
                                                         style="display: none;">
                                                         <div class="notification-content">
                                                             <button
                                                                 style="margin-bottom: 10px; background-color: #282570; color: white; border: none; padding: 5px 10px; font-size: 0.6em; border-radius: 4px; cursor: pointer;"
                                                                 onmouseover="this.style.backgroundColor='#0056b3';"
                                                                 onmouseout="this.style.backgroundColor='#007bff';"
                                                                 onclick="location.href='{{ route('notifications.markAllRead') }}'">
                                                                 Mark All as Read
                                                             </button>
                                                             @foreach (auth()->user()->unreadNotifications as $notification)
                                                                 <div style="margin-bottom: 10px;">
                                                                     @if (isset($notification->data['url']))
                                                                         <a href="{{ $notification->data['url'] }}">
                                                                             {{ $notification->data['message'] }}
                                                                         </a>
                                                                     @else
                                                                         {{ $notification->data['message'] }}
                                                                     @endif
                                                                     <span style="font-size: 0.9em; color: #888;">
                                                                         {{ $notification->created_at->diffForHumans() }}
                                                                     </span>
                                                                 </div>
                                                             @endforeach
                                                         </div>
                                                     </div>
                                                 @else
                                                     <div class="notification-dropdown" id="notificationDropdown"
                                                         style="display: none;">
                                                         <p>No new notifications</p>
                                                     </div>
                                                 @endif
                                             </div> --}}
                                             <div class="wrapper">
                                                 <div class="notification" onclick="toggleNotificationDropdown()">
                                                     <i class="lni lni-alarm"></i>
                                                     @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                                         <div class="notify-count count1 common-count"
                                                             count="{{ auth()->user()->unreadNotifications->count() }}">
                                                             <div class="value">
                                                                 {{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}
                                                             </div>
                                                         </div>
                                                     @endif
                                                 </div>

                                                 <div class="notification-dropdown dd" id="notificationDropdown"
                                                     style="display: none;">
                                                     <div class="arrow-up"></div>
                                                     <div class="header">
                                                         <div class="container">
                                                             <div class="text">Notifications
                                                             </div>

                                                         </div>
                                                     </div>
                                                     <div class="items">
                                                         @if (auth()->user()->unreadNotifications->isNotEmpty())
                                                             <button
                                                                 style="display: block; margin: 10px auto; padding: 5px 10px; background: #282570; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                                                 onclick="location.href='{{ route('notifications.markAllRead') }}'">
                                                                 Mark All as Read
                                                             </button>
                                                             @foreach (auth()->user()->unreadNotifications as $notification)
                                                                 <div
                                                                     style="padding: 10px; border-bottom: 1px solid #D5DFE4; cursor: pointer;">
                                                                     @if (isset($notification->data['url']))
                                                                         <a href="{{ $notification->data['url'] }}"><span
                                                                                 style="color: #2336AB; text-decoration: none;">
                                                                                 {{ $notification->data['message'] }}
                                                                             </span>

                                                                         </a>
                                                                     @else
                                                                         <span> {{ $notification->data['message'] }}
                                                                         </span>
                                                                     @endif
                                                                     <span
                                                                         style="font-size: 12px; color: #888;">{{ $notification->created_at->diffForHumans() }}</span>
                                                                 </div>
                                                             @endforeach
                                                         @else
                                                             <p style="padding: 10px; text-align: center; color: #888;">No
                                                                 new
                                                                 notifications</p>
                                                         @endif
                                                     </div>
                                                 </div>
                                             </div>

                                             <script>
                                                 function toggleNotificationDropdown() {
                                                     const dropdown = document.getElementById('notificationDropdown');
                                                     if (dropdown.style.display === 'none') {
                                                         dropdown.style.display = 'block';
                                                     } else {
                                                         dropdown.style.display = 'none';
                                                     }
                                                 }

                                                 // Close dropdown if clicked outside
                                                 document.addEventListener('click', function(event) {
                                                     const dropdown = document.getElementById('notificationDropdown');
                                                     const notification = document.querySelector('.notification');
                                                     if (!notification.contains(event.target)) {
                                                         dropdown.style.display = 'none';
                                                     }
                                                 });
                                             </script>



                                         </a>
                                     </li>

                                     <li class="user-dropdown">
                                         {{-- <a href="javascript:void(0)" onclick="toggleDropdown()" id="s"> --}}
                                         <img style="height: 50px; width:50px; border-radius:50%; object-fit: cover;"
                                             src="{{ auth()->user()->profile_pic ? asset('storage/' . auth()->user()->profile_pic) : asset('frontend/assets/images/user/user.png') }}"
                                             alt="{{ auth()->user()->first_name }}" class="user-profile-img"
                                             id="profileImg" />
                                         <a id="s">
                                             {{ auth()->user()->first_name }}</a>
                                         {{-- </a> --}}
                                         <i class="lni lni-chevron-down" id="dropdownIcon"></i>
                                         <script>
                                             function toggleDropdown() {
                                                 var dropdownMenu = document.getElementById("userDropdownMenu");
                                                 if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
                                                     dropdownMenu.style.display = "block";
                                                 } else {
                                                     dropdownMenu.style.display = "none";
                                                 }
                                             }
                                             document.getElementById("profileImg").addEventListener("click", toggleDropdown);
                                             document.getElementById("dropdownIcon").addEventListener("click", toggleDropdown);
                                             document.getElementById("s").addEventListener("click", toggleDropdown);
                                             window.onclick = function(event) {
                                                 var dropdown = document.getElementById("userDropdownMenu");
                                                 if (!event.target.matches('#s') && !event.target.matches('#dropdownIcon') && !event.target.matches(
                                                         '#profileImg')) {
                                                     if (dropdown.style.display === "block") {
                                                         dropdown.style.display = "none";
                                                     }
                                                 }
                                             };
                                         </script>
                                         <ul class="dropdown-menu center-align" id="userDropdownMenu" style="top: 60px;">

                                             <li>
                                                 <a href="{{ route('dashboard.index') }}"><i
                                                         class="lni lni-user"></i>Profile</a>
                                             </li>
                                             <li>
                                                 <a href="{{ route('logout') }}"
                                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                     <i class="lni lni-exit"></i> Logout
                                                 </a>
                                                 <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                     style="display: none;">
                                                     @csrf
                                                 </form>
                                             </li>
                                             @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                 <li>
                                                     <a
                                                         href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                         {{ $properties['native'] }}
                                                     </a>
                                                 </li>
                                             @endforeach
                                         </ul>
                                     </li>
                                 @else
                                     <li>
                                         <a href="{{ route('login') }}"><i class="lni lni-enter"></i> Login</a>
                                     </li>
                                     <li>
                                         <a href="{{ route('register') }}"><i class="lni lni-user"></i> Register</a>
                                     </li>
                                 @endauth
                             </ul>
                         </div>

                         <div class="button header-button">
                             <a href="{{ route('ad.create') }}" class="btn">Post Ad</a>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>
         @if (Auth::check() &&
                 (is_null(Auth::user()->phone_number) ||
                     is_null(Auth::user()->profession_id) ||
                     is_null(Auth::user()->country_id) ||
                     is_null(Auth::user()->city_id) ||
                     is_null(Auth::user()->locality_id)))
             <div
                 style="display: block; color: #856404; background-color: #fff3cd; border: 1px solid #ffeeba; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
                 <strong>Notice:</strong> Your profile is incomplete. Please
                 <a href="{{ route('userProfile.edit') }}" style="color: #004085; text-decoration: underline;">update
                     your
                     profile</a>
                 to improve your experience.
             </div>
         @endif
     </div>
 </header>
