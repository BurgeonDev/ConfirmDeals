 <header class="header navbar-area">
     <div class="container">
         <div class="row align-items-center">
             <div class="col-lg-12">
                 <div class="nav-inner">
                     <nav class="navbar navbar-expand-lg">
                         <a class="navbar-brand" href="{{ route('home') }}">
                             <h2 style="display: inline; color: #582fe0;">Confirm</h2>
                             <h3 style="display: inline;">Deals</h3>
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
                                     <a href="{{ route('categories.cat') }}"
                                         aria-label="Toggle navigation">Categories</a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('about') }}" aria-label="Toggle navigation">About Us</a>
                                 </li>
                                 <li class="nav-item">
                                     <a href="{{ route('faq') }}" aria-label="Toggle navigation">FAQ</a>
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
                                     <!-- Notification icon and dropdown -->
                                     <li>
                                         <a>
                                             <div class="notification-icon">
                                                 <i class="lni lni-alarm" id="notificationIcon"></i>
                                                 @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                                                     <span class="notification-count"
                                                         style="height: 15px; width: 15px; font-size: 10px; text-align: left;">
                                                         {{ auth()->user()->unreadNotifications->count() }}
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
                                             </div>

                                         </a>
                                     </li>
                                     <li>
                                         <a href="{{ route('dashboard.index') }}">
                                             <i class="lni lni-user"></i>
                                             {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}


                                         </a>
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
                                 @else
                                     <li>
                                         <a href="{{ route('login') }}"><i class="lni lni-enter"></i> Login</a>
                                     </li>
                                     <li>
                                         <a href="{{ route('register') }}"><i class="lni lni-user"></i> Register</a>
                                     </li>
                                 @endauth
                                 @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                     <li>
                                         <a
                                             href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                             {{ $properties['native'] }}
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>



                         </div>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
 </header>
