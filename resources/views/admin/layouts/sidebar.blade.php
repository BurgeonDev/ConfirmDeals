  <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Home</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                  <i class="mdi mdi-grid-large menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
              </a>
          </li>
          <li class="nav-item nav-category">Location Management</li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#location-management" aria-expanded="false"
                  aria-controls="location-management">
                  <i class="menu-icon mdi mdi-map"></i>
                  <span class="menu-title">Location</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="location-management">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('countries.index') }}">Countries</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('cities.index') }}">Cities</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('localities.index') }}">Localities</a>
                      </li>
                  </ul>
              </div>
          </li>
          @can('Manage User and Roles')
              <li class="nav-item nav-category">User Management</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.userManagement') }}">
                      <i class="mdi mdi-account menu-icon"></i>
                      <span class="menu-title">Users</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.roles.index') }}">
                      <i class="mdi mdi-shield-key-outline menu-icon"></i>
                      <span class="menu-title">Roles</span>
                  </a>
              </li>
          @endcan
          <li class="nav-item">
              <a class="nav-link" href="{{ route('professions.index') }}">
                  <i class="menu-icon mdi mdi-briefcase"></i>
                  <span class="menu-title">Professions</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route('categories.index') }}">
                  <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                  <span class="menu-title">Categories</span>
              </a>
          </li>
          @can('Edit Coins Setting')
              <li class="nav-item nav-category">Coin Management</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('coins.index') }}">
                      <i class="mdi mdi-currency-usd menu-icon"></i>
                      <span class="menu-title">Coins</span>
                  </a>
              </li>
          @endcan
          @can('Edit Ad Status')
              <li class="nav-item nav-category">Ad Management</li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#ad-management" aria-expanded="false"
                      aria-controls="ad-management">
                      <i class="menu-icon mdi mdi-newspaper"></i>
                      <span class="menu-title">Ad </span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ad-management">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('ads.index') }}">Ads</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.reports.index') }}">Reported Ads</a>
                          </li>
                      </ul>
                  </div>
              </li>
          @endcan
          @can('Edit App Setting')
              <li class="nav-item nav-category">App Settings</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.config.index') }}">
                      <i class="mdi mdi-mail menu-icon"></i>
                      <span class="menu-title">Setting</span>
                  </a>
              </li>
          @endcan

      </ul>
  </nav>
