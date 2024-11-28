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
                                 <li class="nav-item">
                                     <a href="{{ route('dashboard') }}" aria-label="Toggle navigation">Dashboard</a>
                                 </li>
                             </ul>
                         </div>
                         <div class="login-button">
                             <ul>
                                 @auth
                                     <li>
                                         <a href="{{ route('dashboard.index') }}"><i class="lni lni-user"></i>
                                             {{ auth()->user()->name }}</a>
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
                             </ul>
                         </div>
                         <div class="button header-button">
                             <a href="{{ route('ads.create') }}" class="btn">Post an Ad</a>
                         </div>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
 </header>
