<div class="u-mt-10" x-data="{ showModalAddUser: false, showModalEditUser: false, showModalViewUser: false }">
    <div class="modal-center" x-show="showModalAddUser" style="display: none;">
        <div class="modal-box" @click.outside="showModalAddUser = false; $wire.clearDataProperties();">
            <div class="modal-content">
                <form wire:submit="addUser">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>

                                    <h3 class="u-fw-b"><i class="fa-solid fa-plus"></i> Add User</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>First name</p>
                                    <input class="u-input" wire:model="first_name" name="first_name" type="text" placeholder="Enter first name" required>
                                </td>
                                <td>
                                    <p>Last Name</p>
                                    <input class="u-input" wire:model="last_name" name="last_name" type="text" placeholder="Enter last name" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Contact</p>
                                    <input class="u-input" wire:model="contact" name="contact" type="text" placeholder="Enter contact number" required>
                                </td>
                                <td>
                                    <p>Email</p>
                                    <input class="u-input" wire:model="email" name="email" type="text" placeholder="Enter email" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Password</p>
                                    <input class="u-input" wire:model="password" name="password" type="password" placeholder="Enter password" required>
                                </td>
                                <td>
                                    <p>Confirm Password</p>
                                    <input class="u-input" wire:model="password_confirmation" name="password_confirmation" type="password" placeholder="Enter confirm password" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Privilege</p>
                                    <select class="u-input" wire:model="privilege_id" name="" id="">
                                        @foreach ($privileges as  $privilege)
                                            <option value="{{ $privilege->id }}">{{ $privilege->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if($errors->hasAny(['first_name', 'last_name', 'contact', 'email', 'password']))
                        <div class="u-m-10 u-bg-danger u-p-10 u-fw-b u-t-white">
                            @error('first_name')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('last_name')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('contact')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('email')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('password')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                        </div>
                    @endif
                    @if(session('add-success'))
                        <div class="u-m-10 u-bg-success u-p-10 u-fw-b u-t-white">
                            <h5>✅ {{ session('add-success') }}</h5>
                        </div>
                    @endif
                    <div class="u-flex-space-between">
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" @click="showModalAddUser = false; $wire.clearDataProperties();" type="button">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-center" x-show="showModalEditUser" style="display: none;">
        <div class="modal-box" @click.outside="showModalEditUser = false; $wire.clearDataProperties();">
            <div class="modal-content">
                <form wire:submit="editUser">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-pencil"></i> Edit User</h3>
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
                                    <input class="u-input" wire:model="e_email" name="email" type="text" placeholder="Enter email" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Password</p>
                                    <input class="u-input" wire:model="e_password" name="e_password" type="password" placeholder="Enter password">
                                </td>
                                <td>
                                    <p>Confirm Password</p>
                                    <input class="u-input" wire:model="e_password_confirmation" name="password_confirmation" type="password" placeholder="Enter confirm password">
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Privilege</p>
                                    <select class="u-input" wire:model="e_privilege_id" name="" id="">
                                        @foreach ($privileges as  $privilege)
                                            <option value="{{ $privilege->id }}">{{ $privilege->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    @if($errors->hasAny(['e_first_name', 'e_last_name', 'e_contact', 'e_email', 'e_password', 'e_password_confirmation']))
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
                    @if(session('edit-success'))
                        <div class="u-m-10 u-bg-success u-p-10 u-fw-b u-t-white">
                            <h5>✅ {{ session('edit-success') }}</h5>
                        </div>
                    @endif
                    <div class="u-flex-space-between">
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button" @click="showModalEditUser = false; $wire.clearDataProperties();">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-center" x-show="showModalViewUser" style="display: none;">
        <div class="modal-box" @click.outside="showModalViewUser = false; $wire.clearDataProperties()">
            <div class="modal-content">
                <form wire:submit="editUser">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-eye"></i> View User</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>First name</p>
                                    <input class="u-input" wire:model="e_first_name" name="first_name" type="text" placeholder="Enter first name" disabled>
                                </td>
                                <td>
                                    <p>Last Name</p>
                                    <input class="u-input" wire:model="e_last_name" name="last_name" type="text" placeholder="Enter last name" disabled>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Contact</p>
                                    <input class="u-input" wire:model="e_contact" name="contact" type="text" placeholder="Enter contact number" disabled>
                                </td>
                                <td>
                                    <p>Email</p>
                                    <input class="u-input" wire:model="e_email" name="email" type="text" placeholder="Enter email" disabled>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Privilege</p>
                                    <select class="u-input" wire:model="e_privilege_id" name="" id="" disabled>
                                        @foreach ($privileges as  $privilege)
                                            <option value="{{ $privilege->id }}">{{ $privilege->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr
                        </tbody>
                    </table>
                    <div class="u-flex-space-between">
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button" @click="showModalViewUser = false; $wire.clearDataProperties();">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="u-flex-space-between u-flex-wrap u-mt-16 u-mb-16">
        <div class="u-flex-alignIt-center">
            <select class="u-btn u-box-shadow-default u-mr-5" wire:model="paginate" wire:change="$set('paginate', $event.target.value)">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
            <button class="u-t-white u-fw-b u-btn u-bg-primary u-mr-5" type="button" id="add-user" @click="showModalAddUser = true"><i class="fa-solid fa-plus"></i> Add User</button>
            <button class="u-t-gray u-fw-b u-btn u-bg-default u-mr-5" type="button" id="export"><i class="fa-solid fa-download"></i> Export</button>
        </div>
        
        <div class="u-flex">
            @livewire('assets.sort-filter', ['column_names' => $columns])
            <input class="u-input" style="max-width: 15.635rem;" wire:model.live="search" type="text" placeholder="Search">
        </div>
    </div>
    <div style="overflow-x: auto; border-radius: 0.5rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <table class="u-responsive-table">
            <tr class="u-fw-b">
                @foreach ($columns as $column)
                    <td>{{ ucwords(str_replace('_', ' ', $column)) }}</td>
                @endforeach
                <td>Action</td>
            </tr>
            @foreach ($users as $user)
                <tr class="u-t-gray">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->contact }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="u-fw-b {{ $user->status == 'ACTIVE' ? 'u-t-success' : 'u-t-danger' }}">{{ $user->status }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn u-bg-primary u-t-white" wire:click="viewUser({{ $user->id }})" @click="showModalEditUser = true;" type="button"><i class="fa-solid fa-pencil"></i></button>
                            <button class="action-btn u-bg-warning u-t-white" wire:click="viewUser({{ $user->id }})" @click="showModalViewUser = true;" type="buton"><i class="fa-regular fa-eye"></i></button>
                            @if ($user->status == 'ACTIVE')
                            <button class="action-btn u-bg-danger u-t-white" wire:click="inactiveUser({{ $user->id }})" type="button"><i class="fa-solid fa-xmark"></i></button>
                            @else
                            <button wire:click="activeUser({{ $user->id }})" class="action-btn u-bg-success u-t-white" type="button"><i class="fa-solid fa-check"></i></button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class="u-flex-space-between u-flex-wrap u-mt-10">
        {{ $users->links('livewire::default') }}
        <div class="u-flex-alignIt-center">
            <h5 :class="(darkMode ? 'u-t-white' : '')">
                Showing record(s) :
                {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }}
            </h5>
        </div>
    </div>
</div>
