<div 
    x-data="{ showModalAddPrivilege: false, 
        showModalEditPrivilege: false, 
        showModalViewPrivilege: false,

        clearSelect(select2) {
            const selectedModule = select2; 
            selectedModule.value = '';
            selectedModule.dispatchEvent(new Event('change'))
        }
}">

    <div class="modal-center" x-show="showModalAddPrivilege" style="display: none;">
        <div class="modal-box" @click.outside="showModalAddPrivilege = false; $wire.clearMessageSession(); clearSelect($refs.aSelect2)" >
            <div class="modal-content">
                <form wire:submit="addPrivilege">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-plus"></i> Add User Privilege</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Privilege name</p>
                                    <input class="u-input" wire:model="add_privilege_name" name="add_privilege_name" type="text" placeholder="Enter privilege name" required>
                                </td>                          
                            </tr>
                            <tr wire:ignore>
                                <td>
                                    <p>Privilege Module Access</p>
                                    <select class="u-input u-select2" wire:model="add_privilege_access" id="add-select2" x-ref="aSelect2" multiple>
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Status</p>
                                    <select class="u-input" wire:model="add_status" name="add_status" id="status" required>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </td>  
                            </tr>
                            
                        </tbody>
                    </table>
                    @if(session('add-success'))
                    <div class="u-m-10 u-bg-success u-p-10 u-fw-b u-t-white">
                        <h5>✅ {{ session('add-success') }}</h5>
                    </div>
                    @endif
                    <div class="u-flex-space-between" x-data="{
                        clearSelectedOptions: function(){
                            return;
                            // Get all elements with class .ss-value-delete
                            var deleteButtons = document.querySelectorAll('.ss-value-delete');

                            // Trigger click event on each delete button
                            deleteButtons.forEach(function(button) {
                                button.click();
                            });
                        }
                    }">
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button" @click="showModalAddPrivilege = false; clearSelectedOptions(); $wire.clearDataProperties(); $wire.clearMessageSession()">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-center" x-show="showModalEditPrivilege" style="display: none;">
        <div class="modal-box" @click.outside="showModalEditPrivilege = false; $wire.clearMessageSession(); $wire.clearDataProperties(); clearSelect($refs.eSelect2)">
            <div class="modal-content">
                <form wire:submit="editPrivilege">
                    @csrf
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h3 class="u-fw-b"><i class="fa-solid fa-plus"></i> Edit User Privilege</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Privilege name</p>
                                    <input class="u-input" wire:model="edit_privilege_name" name="edit_privilege_name" type="text" placeholder="Enter privilege name" required>
                                </td>                          
                            </tr>
                            <tr wire:ignore>
                                <td>
                                <p>Privilege Module Access</p>
                                    <select class="u-input u-edit-select2" wire:model="edit_privilege_access" id="edit-select2" x-ref="eSelect2" multiple>
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Status</p>
                                    <select class="u-input" wire:model="edit_status" name="edit_status" id="status" required>
                                        <option value="ACTIVE" selected>ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </td>  
                            </tr>
                        </tbody>
                    </table>
                    @if(session('edit-success'))
                    <div class="u-m-10 u-bg-success u-p-10 u-fw-b u-t-white">
                        <h5>✅ {{ session('edit-success') }}</h5>
                    </div>
                    @endif
                    <div class="u-flex-space-between">
                        <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button" @click="showModalEditPrivilege = false; $wire.clearMessageSession(); clearSelect()">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-center" x-show="showModalViewPrivilege" style="display: none;">
        <div class="modal-box" @click.outside="showModalViewPrivilege = false; $wire.clearMessageSession(); $wire.clearDataProperties(); clearSelect($refs.vSelect2)">
            <div class="modal-content">
                <table class="custom_normal_table">
                    <tbody>
                        <tr>
                            <td>
                                <h3 class="u-fw-b"><i class="fa-solid fa-eye"></i> View User Privilege</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Privilege name</p>
                                <input class="u-input" wire:model="edit_privilege_name" name="edit_privilege_name" type="text" placeholder="Enter privilege name" disabled>
                            </td>                          
                        </tr>
                        <tr wire:ignore>
                            <td>
                            <p>Privilege Module Access</p>
                                <select class="u-input u-edit-select2" wire:model="edit_privilege_access" x-ref="vSelect2" multiple disabled>
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Status</p>
                                <select class="u-input" wire:model="edit_status" name="edit_status" id="status" disabled>
                                    <option value="ACTIVE" selected>ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </td>  
                        </tr>
                    </tbody>
                </table>
                @if(session('edit-success'))
                <div class="u-m-10 u-bg-success u-p-10 u-fw-b u-t-white">
                    <h5>✅ {{ session('edit-success') }}</h5>
                </div>
                @endif
                <div class="u-flex-space-between">
                    <button class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button" @click="showModalViewPrivilege = false; $wire.clearMessageSession(); clearSelect($refs.vSelect2)">Close</button>
                </div>
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
            <button class="u-t-white u-fw-b u-btn u-bg-primary u-mr-5" type="button" id="add-user" @click="showModalAddPrivilege = true"><i class="fa-solid fa-plus"></i> Add Privilege</button>
        </div>
        <input class="u-input" style="max-width: 15.635rem;" wire:model.live="search" type="text" placeholder="Search">
    </div>
    <div style="overflow-x: auto; border-radius: 0.5rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <table class="u-responsive-table">
            <tr class="u-fw-b">
                <td>ID</td>
                <td>Privilege Name</td>
                <td>Status</td>
                <td>Created By</td>
                <td>Created At</td>
                <td>Updated By</td>
                <td>Updated At</td>
                <td>Action</td>
            </tr>
            @foreach ($privileges as $privilege)
                <tr class="u-t-gray">
                    <td>{{ $privilege->id }}</td>
                    <td>{{ $privilege->name }}</td>
                    <td class="u-fw-b {{ $privilege->status == 'ACTIVE' ? 'u-t-success' : 'u-t-danger' }}">{{ $privilege->status }}</td>
                    <td>{{ $privilege->created_by }}</td>
                    <td>{{ $privilege->created_at }}</td>
                    <td>{{ $privilege->updated_by }}</td>
                    <td>{{ $privilege->updated_at }}</td>
                    <td>
                        <div class="action-btns">
                            <button id="test" wire:click="viewPrivilege({{ $privilege->id }})" @click="showModalEditPrivilege = true;" class="action-btn u-bg-primary u-t-white" type="button"><i class="fa-solid fa-pencil"></i></button>
                            <button wire:click="viewPrivilege({{ $privilege->id }})" @click="showModalViewPrivilege = true;" class="action-btn u-bg-warning u-t-white"><i class="fa-regular fa-eye"></i></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="u-flex-space-between u-flex-wrap u-mt-10">
        {{ $privileges->links('livewire::default') }}
        <div class="u-flex-alignIt-center">
            <h5 :class="(darkMode ? 'u-t-white' : '')">
                Showing record(s) :
                {{ $privileges->firstItem() }} to {{ $privileges->lastItem() }} of {{ $privileges->total() }}
            </h5>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(() => {
        $('.u-select2, .u-edit-select2').select2({
            width: '100%'
        })

        $wire.on('view-success', (data) => {
            data.message.forEach((value) => {
                $('.u-edit-select2 option[value="' + value + '"]').prop('selected', true);
            });

            $('.u-edit-select2').trigger('change');
        });

        $('#add-select2').on('change', function(){
            let data = $(this).val();
            $wire.set('add_privilege_access', data)
        })

        $('#edit-select2').on('change', function(){
            let data = $(this).val();
            $wire.set('edit_privilege_access', data)
        })
    })

</script>
@endscript


