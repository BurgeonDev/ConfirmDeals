<nav class="flex-row p-0 navbar default-layout col-lg-12 col-12 fixed-top d-flex align-items-top">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">

                <h3 style="display: inline; color: #582fe0;">Confirm</h3>
                <h4 style="display: inline;">Deals</h4>

            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Welcome, <span class="text-black fw-bold">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}</span></h1>
                {{-- <h3 class="welcome-sub-text">Your performance summary this week </h3> --}}
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="menu-icon fa fa-bars"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    {{-- <div class="text-center dropdown-header">
                         <img class="img-md rounded-circle" src="{{ asset('admin/assets/images/faces/face8.jpg') }}"
                             alt="Profile image">
                         <p class="mt-3 mb-1 fw-semibold">{{ Auth::user()->name }}</p>
                         <p class="mb-0 fw-light text-muted">{{ Auth::user()->email }}</p>
                     </div> --}}
                    <div class="text-center dropdown-header">
                        <div
                            style="
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: white;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 60px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        ">
                            <span>{{ strtoupper(Auth::user()->first_name[0]) }}</span>
                        </div>
                        <p class="mt-3 mb-1 fw-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </p>
                        <p class="mb-0 fw-light text-muted">{{ Auth::user()->email }}</p>
                    </div>


                    <!-- Profile Link -->
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                        {{ __('Profile') }}
                    </a>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
