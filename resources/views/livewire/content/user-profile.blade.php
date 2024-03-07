<div class="u-mt-10">
    <div class="u-flex u-flex-wrap" style="gap: 1rem;">
        <div class="user-profile-box flex-1 u-box-shadow-default u-bg-white">
            <div class="u-p-5">
                <form wire:submit="editUser" enctype="multipart/form-data" autocomplete="off">
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="u-flex-alignIt-center">
                                        <div class="s-box-sm u-p-10-15 u-border-radius-5 u-mr-5">
                                            <h3 class="u-t-primary"><i class="fa-solid fa-user"></i></h3>
                                        </div>
                                        <h4 class="u-fw-b u-t-gray">User Information</h4>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="u-fw-300">First name</p>
                                    <input class="u-input" wire:model="e_first_name" type="text" placeholder="Enter first name" required>
                                </td>
                                <td>
                                    <p class="u-fw-300">Last Name</p>
                                    <input class="u-input" wire:model="e_last_name" type="text" placeholder="Enter last name" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p class="u-fw-300">Contact</p>
                                    <input class="u-input" wire:model="e_contact" type="text" placeholder="Enter contact number" required>
                                </td>
                                <td>
                                    <p class="u-fw-300">Email</p>
                                    <input class="u-input" wire:model="e_email" type="text" placeholder="Enter email" disabled>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p class="u-fw-300">Password</p>
                                    <input class="u-input" wire:model="e_password" type="password" placeholder="Enter password">
                                </td>
                                <td>
                                    <p class="u-fw-300">Confirm Password</p>
                                    <input class="u-input" wire:model="e_password_confirmation" type="password" placeholder="Enter confirm password">
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p class="u-fw-300">Change Profile Picture</p>
                                    <input class="u-input" id="profile-picture" wire:model="e_img" type="file" accept="image/*">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if($errors->hasAny(['e_first_name', 'e_last_name', 'e_contact', 'e_email', 'e_password']))
                    <div class="u-m-10 u-bg-danger u-p-10 u-fw-b u-t-white">
                        @error('e_first_name')
                            <h5>⚠️ {{ $message }}</h5>
                        @enderror
                        @error('e_last_name')
                            <h5>⚠️ {{ $message }}</h5>
                        @enderror
                        @error('e_contact')
                            <h5>⚠️ {{ $message }}</h5>
                        @enderror
                        @error('e_email')
                            <h5>⚠️ {{ $message }}</h5>
                        @enderror
                        @error('e_password')
                            <h5>⚠️ {{ $message }}</h5>
                        @enderror
                    </div>
                    @endif
                    <div class="u-flex-end u-mb-5">
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit"><i class="fa-solid fa-pencil"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="user-profile-box flex-2">
            <div class="">
                <div class="u-p-5">
                    <form action="{{ route('update-app-setting', auth()->user()->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <table class="custom_normal_table u-box-shadow-default u-bg-white">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="u-flex-alignIt-center">
                                            <div class="s-box-sm u-p-10-15 u-border-radius-5 u-mr-5">
                                                <h3 class="u-t-primary"><i class="fa-solid fa-gear"></i></h3>
                                            </div>
                                            <h4 class="u-fw-b u-t-gray">Application Settings</h4>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="u-fw-300">Dark mode</p>
                                        <select class="u-input" name="dark_mode" required>
                                            @if ($user->dark_mode == 'TRUE')
                                                <option value="TRUE" selected>TRUE</option>
                                                <option value="FALSE">FALSE</option>
                                                @else
                                                <option value="TRUE">TRUE</option>
                                                <option value="FALSE" selected>FALSE</option>
                                            @endif
                                        </select>
                                    </td>
                                @if (auth()->user()->privilege_id == 1)
                                    <td>
                                        <p class="u-fw-300">Topbar background color</p>
                                        <input class="u-input" name="topbar_bg" type="text" value="{{ $app_settings->topbar_bg }}" placeholder="Enter css code" required>
                                    </td>                            
                                </tr>
                                    <tr>
                                        <td>
                                            <p class="u-fw-300">Sidebar background color</p>
                                            <input class="u-input" name="sidebar_bg" type="text" value="{{ $app_settings->sidebar_bg }}" placeholder="Enter css code" required>
                                        </td>
                                        <td>
                                            <p class="u-fw-300">Sidebar logo image</p>
                                            <input class="u-input" name="sidebar_img" type="file" accept="image/*">
                                        </td>                         
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="u-fw-300">Sidebar company name</p>
                                            <input class="u-input" name="sidebar_title" type="text" value="{{ $app_settings->sidebar_title_name }}" placeholder="Enter company name" required>
                                        </td>
                                        <td>
                                            <p class="u-fw-300">Footer company name</p>
                                            <input class="u-input" name="footer_title" type="text" value="{{ $app_settings->footer_company_name }}" placeholder="Enter company name" required>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="u-fw-300">Login Background Image</p>
                                            <input class="u-input" name="login_bg" type="file" accept="image/*">
                                        </td>
                                @endif
                                        <td>
                                            <p style="visibility: hidden;">Action</p>
                                            <div class="u-flex-end">
                                                <button class="u-t-white u-fw-b u-btn u-bg-primary u-border-1-default" type="submit"><i class="fa-solid fa-gear"></i> Submit</button>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $wire.on('refreshComponent', (data) => {
        $wire.clearDataProperties()
        $('#profile-picture').val('');

        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                container: 'custom-toast'
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
            icon: "success",
            title: data.message
        });

    });

    if("{{ session('edit-success') }}"){
        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                container: 'custom-toast'
            },
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
            icon: "success",
            title: "{{ session('edit-success') }}"
        });
    }
</script>
@endscript
