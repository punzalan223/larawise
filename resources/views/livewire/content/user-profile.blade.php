<div class="u-mt-10">
    <div class="u-flex u-flex-wrap" style="gap: 1rem;">
        <div class="user-profile-box flex-1 u-bg-white">
            <div class="u-p-5">
                <form action="">
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-user"></i> Edit User</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>First name</p>
                                    <input class="u-input" wire:model="first_name" value="{{ auth()->user()->first_name }}" name="first_name" type="text" placeholder="Enter first name" required>
                                </td>
                                <td>
                                    <p>Last Name</p>
                                    <input class="u-input" wire:model="last_name" value="{{ auth()->user()->last_name }}" name="last_name" type="text" placeholder="Enter last name" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Contact</p>
                                    <input class="u-input" wire:model="contact" value="{{ auth()->user()->contact }}" name="contact" type="text" placeholder="Enter contact number" required>
                                </td>
                                <td>
                                    <p>Email</p>
                                    <input class="u-input" wire:model="email" value="{{ auth()->user()->email }}" name="email" type="text" placeholder="Enter email" disabled>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Password</p>
                                    <input class="u-input" wire:model="password" name="password" type="password" placeholder="Enter password">
                                </td>
                                <td>
                                    <p>Confirm Password</p>
                                    <input class="u-input" wire:model="password_confirmation" name="password_confirmation" type="password" placeholder="Enter confirm password">
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Change Profile Picture</p>
                                    <input class="u-input" type="file" accept="image/*">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="u-flex-end u-mb-5">
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit"><i class="fa-solid fa-pencil"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="user-profile-box flex-2 u-bg-white">
            <div>
                <h3 class="u-fw-b">Settings</h1>
            </div>
        </div>
    </div>
</div>
