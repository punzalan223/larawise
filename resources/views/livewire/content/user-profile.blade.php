<div class="u-mt-10">
    <div class="u-flex u-flex-wrap" style="gap: 1rem;">
        <div class="user-profile-box flex-1 u-box-shadow-default u-bg-white">
            <div class="u-p-5">
                <form wire:submit="editUser">
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="u-flex-alignIt-center">
                                        <div class="s-box-sm u-p-10-15 u-border-radius-5 u-mr-5">
                                            <h3 class="u-t-primary"><i class="fa-solid fa-user"></i></h3>
                                        </div>
                                        <h4 class="u-fw-b u-t-dark">User Information</h4>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>First name</p>
                                    <input class="u-input" wire:model="e_first_name" name="first_name" type="text" placeholder="Enter first name" required>
                                </td>
                                <td>
                                    <p>Last Name</p>
                                    <input class="u-input" wire:model="e_last_name" name="last_name" type="text" placeholder="Enter last name" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Contact</p>
                                    <input class="u-input" wire:model="e_contact" name="contact" type="text" placeholder="Enter contact number" required>
                                </td>
                                <td>
                                    <p>Email</p>
                                    <input class="u-input" wire:model="e_email" name="email" type="text" placeholder="Enter email" disabled>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Password</p>
                                    <input class="u-input" wire:model="e_password" name="password" type="password" placeholder="Enter password">
                                </td>
                                <td>
                                    <p>Confirm Password</p>
                                    <input class="u-input" wire:model="e_password_confirmation" name="password_confirmation" type="password" placeholder="Enter confirm password">
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Change Profile Picture</p>
                                    <input class="u-input" wire:model="e_photo" type="file" accept="image/*">
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
                                            <h4 class="u-fw-b u-t-dark">Application Settings</h4>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Dark mode</p>
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
                                    <td>
                                        <p>Topbar background color</p>
                                        <input class="u-input" name="topbar_bg" type="text" value="{{ $app_settings->topbar_bg }}" placeholder="Enter css code" required>
                                    </td>                            
                                </tr>
                                @if (auth()->user()->privilege_id == 1)
                                    <tr>
                                        <td>
                                            <p>Sidebar background color</p>
                                            <input class="u-input" name="sidebar_bg" type="text" value="{{ $app_settings->sidebar_bg }}" placeholder="Enter css code" required>
                                        </td>
                                        <td>
                                            <p>Sidebar logo image</p>
                                            <input class="u-input" name="sidebar_img" type="file" accept="image/*">
                                        </td>                         
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Sidebar company name</p>
                                            <input class="u-input" name="sidebar_title" type="text" value="{{ $app_settings->sidebar_title_name }}" placeholder="Enter company name" required>
                                        </td>
                                        <td>
                                            <p>Footer company name</p>
                                            <input class="u-input" name="footer_title" type="text" value="{{ $app_settings->footer_company_name }}" placeholder="Enter company name" required>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Login Background Image</p>
                                            <input class="u-input" name="login_bg" type="file" accept="image/*">
                                        </td>
                                        <td>
                                            <p style="visibility: hidden;">Action</p>
                                            <div class="u-flex-end">
                                                <button class="u-t-white u-fw-b u-btn u-bg-primary u-border-1-default" type="submit"><i class="fa-solid fa-gear"></i> Submit</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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
    $wire.on('edit-success', (data) => {
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
