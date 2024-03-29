<div class="sidebar-box" x-show="showSidenav" x-transition.duration.300ms style='{{ $app_settings->sidebar_bg ? "background: $app_settings->sidebar_bg" : '' }}' @click.outside="screenWidth()">
    <a href="{{ url('/dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-content">
            <div>
                <img src="{{ asset("img/logo/$app_settings->sidebar_logo_img") }}" alt="" id="store-logo-img">
            </div>
            <div class="company-name">
                <h4 class="u-t-center u-t-white u-fw-b">{{ $app_settings->sidebar_title_name ? $app_settings->sidebar_title_name : 'Larawise'}}</h4>
            </div>
        </div>
    </a>
    <div class="sidebar-body">
        <div class="sidebar-user">
            <div class="sidebar-profile-content">
                <a href="{{ $lw_user->img ? asset('img/user-profiles/' . $lw_user->img) . '?v=' . time() : asset('img/icons/user.png') }}" data-fslightbox="gallery" >
                    <img src="{{ $lw_user->img ? asset('img/user-profiles/' . $lw_user->img) . '?v=' . time() : asset('img/icons/user.png') }}" alt="">
                </a>
            </div>
            
            <div class="sidebar-name">
                <h6 class="u-t-white u-fw-b">{{ auth()->user()->name }}</h6>
            </div>
        </div>
        <div class="sidebar-modules">
            <ul>
                <li class="u-ptb-10">
                    <h6 class="u-t-white">Module</h6>
                </li>
                <li>
                    <a class="u-t-white {{ Request::segment(1) == 'dashboard' ? "url-active" : '' }}" href="{{ url('/dashboard') }}" wire:navigate>
                        <img src="{{ asset('img/icons/dashboard.png') }}" alt="">
                        <h5 class="u-fw-b">Dashboard</h6>
                    </a>
                </li>
                @foreach ($modules as $module)
                    @if($privilege_access)
                        @if (in_array($module->id, explode(',',$privilege_access->privilege_access_id)))
                            <li>
                                <a class="u-t-white {{ Request::segment(1) == "$module->route_name" ? "url-active" : '' }}" href="{{ url("/$module->route_name") }}" wire:navigate>
                                    <img src="{{ asset("img/icons/$module->icon_img_path") }}" alt="">
                                    <h5 class="u-fw-b">{{ $module->name }}</h6>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
                @if (auth()->user()->privilege_id == 1)
                    <li class="u-ptb-10">
                        <h6 class="u-t-white">Submaster</h6>
                    </li>
                    <li class="u-ptb-10">
                        <h6 class="u-t-white">Admin</h6>
                    </li>
                    <li x-data="{ dropdown: $persist(false).using(sessionStorage), dropdownPrivileges: $persist(false).using(sessionStorage) }">
                        <a class="u-t-white" @click="dropdownPrivileges= !dropdownPrivileges;">
                            <img src="{{ asset('img/icons/take-note.png') }}" alt="">
                            <h5 class="u-fw-b">Privileges</h5>
                        </a>
                        <div x-show="dropdownPrivileges" x-transition.duration.300ms style="display: none; background-color: #dddddd15; border-radius: 5px;">
                            <a class="u-t-white u-pl-16 {{ Request::segment(1) == 'add-user-privilege' ? 'url-active' : '' }}" wire:navigate href="{{ url('/add-user-privilege') }}">
                                <img src="{{ asset('img/icons/monitor.png') }}" alt="">
                                <h6 class="">Add privilege</h6>
                            </a>
                        </div>
                        <a class="u-t-white {{ Request::segment(1) == 'add-user' ? 'url-active' : '' }}" wire:navigate href="{{ url('/add-user') }}">
                            <img src="{{ asset('img/icons/user-profiles.png') }}" alt="">
                            <h5 class="u-fw-b">User Accounts</h5>
                        </a>
                        <a class="u-t-white {{ Request::segment(1) == 'module-generator' ? 'url-active' : '' }}" wire:navigate href="{{ url('/module-generator') }}">
                            <img src="{{ asset('img/icons/pencil.png') }}" alt="">
                            <h5 class="u-fw-b">Module Generator</h5>
                        </a>
                        <a class="u-t-white {{ Request::segment(1) == 'user-logs' ? 'url-active' : '' }}" wire:navigate href="{{ url('/user-logs') }}">
                            <img src="{{ asset('img/icons/log.png') }}" alt="">
                            <h5 class="u-fw-b">Logs</h5>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>



