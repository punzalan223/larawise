<div class="u-mt-10" x-data="{ showModalAddModule: false, showModalEditModule: false, showModalViewModule: false }">
    <div class="modal-center" x-show="showModalAddModule" style="display: none;">
        <div class="modal-box" @click.outside="showModalAddModule = false; $wire.clearDataProperties();">
            <div class="modal-content">
                <form wire:submit="addModule">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-plus"></i> Add Module</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Module name</p>
                                    <input class="u-input" wire:model="a_module_name" name="first_name" type="text" placeholder="Module name" required>
                                </td>
                                <td>
                                    <p>Controller Name</p>
                                    <input class="u-input" wire:model="a_controller_name" name="last_name" type="text" placeholder="Enter controller name" required>
                                </td>                            
                            </tr>
                            <tr>
                                <td>
                                    <p>Route Name</p>
                                    <input class="u-input" wire:model="a_route_name" name="contact" type="text" placeholder="Enter route Name" required>
                                </td>
                                <td>
                                    <p>Icon filename</p>
                                    <input class="u-input" wire:model="a_icon_path" name="" type="text" placeholder="Enter the icon filename" required>
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                    @if($errors->hasAny(['a_module_name', 'a_controller_name', 'a_route_name']))
                        <div class="u-m-10 u-bg-danger u-p-10 u-fw-b u-t-white">
                            @error('a_module_name')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('a_controller_name')
                                <h5>⚠️ {{ $message }}</h5>
                            @enderror
                            @error('a_route_name')
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
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" @click="showModalAddModule = false; $wire.clearDataProperties();" type="button">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
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
            <button class="u-t-white u-fw-b u-btn u-bg-primary u-mr-5" type="button" id="add-user" @click="showModalAddModule = true"><i class="fa-solid fa-plus"></i> Add Module</button>
            <button class="u-t-white u-fw-b u-btn u-bg-primary u-mr-5" type="button" id="export"><i class="fa-solid fa-download"></i> Export</button>
        </div>
        <input class="u-input" style="max-width: 15.635rem;" wire:model.live="search" type="text" placeholder="Search">
    </div>
    <div style="overflow-x: auto; border-radius: 0.5rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <table class="u-responsive-table">
            <tr class="u-fw-b">
                <td>ID</td>
                <td>Name</td>
                <td>Controller Name</td>
                <td>Icon filename</td>
                <td>Route Name</td>
                <td>Created by</td>
                <td>Created at</td>
                <td>Action</td>
            </tr>
            @foreach ($modules as $module)
                <tr class="u-t-gray">
                    <td>{{ $module->id }}</td>
                    <td>{{ $module->name }}</td>
                    <td>{{ $module->controller_name }}</td>
                    <td>{{ $module->icon_img_path }}</td>
                    <td>{{ $module->route_name }}</td>
                    <td>{{ $module->created_by }}</td>
                    <td>{{ $module->created_at }}</td>
                    <td>
                        <div class="action-btns">
                            <button class="action-btn u-bg-primary u-t-white" wire:click="viewModule({{ $module->id }})" @click="showModalEditUser = true;" type="button"><i class="fa-solid fa-pencil"></i></button>
                            <button class="action-btn u-bg-warning u-t-white" wire:click="viewModule({{ $module->id }})" @click="showModalViewUser = true;" type="buton"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class="u-flex-space-between u-flex-wrap u-mt-10">
        {{ $modules->links('livewire::default') }}
        <div class="u-flex-alignIt-center">
            <h5 :class="(darkMode ? 'u-t-white' : '')">
                Showing record(s) :
                {{ $modules->firstItem() }} to {{ $modules->lastItem() }} of {{ $modules->total() }}
            </h5>
        </div>
    </div>
</div>
