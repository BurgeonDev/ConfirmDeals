<div class="col-lg-3 col-md-4 col-12">
    <!-- Start Dashboard Sidebar -->
    <div class="dashboard-sidebar">
        <div class="user-image">

            <h4>{{ auth()->user()->name }}</h4>
            <h6>
                Status:
                <span class="status-dot"
                    style="background-color: {{ auth()->user()->is_active == 1 ? 'green' : 'red' }};">
                </span>
                {{ auth()->user()->is_active == 1 ? 'Active' : 'Not Active' }}
            </h6>
            <h6>
                Coins: <i style="color: goldenrod" class="fas fa-coins"></i> {{ auth()->user()->coins }}
            </h6>
        </div>



        <div class="dashboard-menu">
            <ul>
                <li><a class="active" href="{{ route('dashboard.index') }}"><i class="lni lni-circle-plus"></i>
                        Dashbaord</a></li>
                <li><a class="active" href="{{ route('userProfile.edit') }}"><i class="lni lni-circle-plus"></i>
                        Profile</a></li>
                <li><a class="active" href="{{ route('ad.create') }}"><i class="lni lni-circle-plus"></i>
                        Post An
                        Ad</a></li>
                <li><a class="active" href="{{ route('ad.index') }}"><i class="lni lni-circle-plus"></i>
                        My Ads</a></li>

            </ul>
            <div class="button">
                <a class="btn" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <!-- End Dashboard Sidebar -->
</div>
