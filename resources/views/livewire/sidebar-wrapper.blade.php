<div class="sidebar-box" x-show="showSidenav" x-transition.duration.300ms>
    <a href="" class="sidebar-logo">
        <div class="sidebar-logo-content">
            <div>
                <img src="{{ asset('img/digits-assets/digits-icon.png') }}" alt="" id="store-logo-img">
            </div>
            <div class="company-name">
                <h4 class="u-t-center u-t-white u-fw-b">Larawise</h4>
            </div>
        </div>
    </a>
    <div class="sidebar-body">
        <div class="sidebar-user">
            <div class="sidebar-profile-content">
                <img src="{{ asset('img/user-profile/patrick.jpg') }}" alt="">
            </div>
            <div class="sidebar-name">
                <h6 class="u-t-white u-fw-b">Patrick Lester Punzalan</h6>
            </div>
        </div>
        <div class="sidebar-modules">
            <ul>
                <li>
                    <a class="u-t-white {{ Request::segment(1) == 'dashboard' ? "url-active" : '' }}" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('img/icons/dashboard.png') }}" alt="">
                        <h5 class="u-fw-b">Dashboard</h6>
                    </a>
                </li>
                <li>
                    <a class="u-t-white {{ Request::segment(1) == 'add-user' ? "url-active" : '' }}" href="{{ url('/add-user') }}">
                        <img src="{{ asset('img/icons/user-profiles.png') }}" alt="">
                        <h5 class="u-fw-b">User Accounts</h6>
                    </a>
                </li>
                <li>
                    <a class="u-t-white {{ Request::segment(1) == 'add-user-privilege' ? "url-active" : '' }}" href="{{ url('/add-user-privilege') }}">
                        <img src="{{ asset('img/icons/monitor.png') }}" alt="">
                        <h5 class="u-fw-b">User Privileges</h6>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
