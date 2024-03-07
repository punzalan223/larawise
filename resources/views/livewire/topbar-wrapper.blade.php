<div class="topbar">
    <div class="topbar-box u-flex-space-between" :class="(darkMode ? 'u-bg-dm-l-dark' : '') + (!showSidenav ? ' topbar-sticky' : '')" style='{{ $app_settings->topbar_bg ? "background: $app_settings->topbar_bg" : '' }}'>
        <div class="topbar-box-content">
            <h4 @click="showSidenav = !showSidenav"><i class="fa-solid fa-bars" :class="darkMode ? 'u-t-dm-white' : ''"></i></h4>
        </div>
        <div class="topbar-box-content" x-data="{ showSetting: false }">
            <div>
                <h4 class="u-mr-16"><i class="fa-solid fa-bell" :class="darkMode ? 'u-t-dm-white' : ''"></i></h4>
            </div>
            <div @click.outside="showSetting = false;">
                <h4 @click="showSetting = !showSetting"><i class="fa-solid fa-gear" :class="darkMode ? 'u-t-dm-white' : ''"></i></h4>
                <div class="small-box" x-show="showSetting" x-transition.duration.300ms style="display: none; position: absolute;">
                    <div class="user-profile-info  u-flex-center-column" style='{{ $app_settings->sidebar_bg ? "background: $app_settings->sidebar_bg" : '' }}'>
                        <img src="{{ auth()->user()->img ? asset('img/user-profiles/'.auth()->user()->img) : asset('img/icons/user.png') }}" alt="">
                        <h5 class="u-t-white u-mt-5">{{ auth()->user()->name }}</h5>
                        <h6 class="u-t-white">{{ $ls_user->privilege_name }}</h6>
                    </div>
                    <div class="user-profile-actions u-flex-center-row">
                        <a class="u-btn u-t-white u-bg-primary" wire:navigate style="margin-right: 5px;" href="{{ route('user-profile', auth()->user()->id) }}">Profile</a>
                        <a class="u-btn u-t-white u-bg-danger" style="margin-left: 5px;" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="topbar-body">
        <div class="topbar-header">
            <h3 class="u-t-gray" :class="darkMode ? 'u-t-dm-white' : ''">@yield('title')</h3>
        </div>
        <div class="topbar-content">
            @yield('content')
        </div>
    </div>
    <div class="footer" :class="darkMode ? 'u-bg-dm-l-dark' : ''">
        <div :class="darkMode ? 'u-t-dm-white' : ''">&copy; 2024 {{ $app_settings->footer_company_name }}. All rights reserved.</div>
    </div>
</div>