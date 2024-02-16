<div class="topbar">
    <div class="topbar-box u-flex-space-between">
        <div class="topbar-box-content">
            <h4 @click="showSidenav = !showSidenav"><i class="fa-solid fa-bars"></i></h4>
        </div>
        <div class="topbar-box-content" x-data="{ showSetting: false }">
            <div>
                <h4 class="u-mr-16"><i class="fa-solid fa-bell"></i></h4>
            </div>
            <div @click.outside="showSetting = false;">
                <h4 @click="showSetting = !showSetting"><i class="fa-solid fa-gear"></i></h4>
                <div class="small-box" x-show="showSetting" style="display: none; position: absolute;">
                    <div class="user-profile-info  u-flex-center-column">
                        <img src="{{ auth()->user()->img ? asset('storage/img/user-profiles/'.auth()->user()->img) : '' }}" alt="">
                        <h5 class="u-t-white u-mt-5">{{ auth()->user()->name }}</h5>
                        <h6 class="u-t-white">SuperAdmin</h6>
                    </div>
                    <div class="user-profile-actions u-flex-center-row">
                        <a class="u-btn u-t-white u-bg-primary" style="margin-right: 5px;" href="{{ route('user-profile') }}">Profile</a>
                        <a class="u-btn u-t-white u-bg-danger" style="margin-left: 5px;" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-body">
        <div class="topbar-header">
            <h3 class="u-t-gray">@yield('title')</h3>
        </div>
        <div class="topbar-content">
            @yield('content')
        </div>
    </div>
    <div class="footer">
        <div>&copy; 2024 Larawise. All rights reserved.</div>
    </div>
</div>
