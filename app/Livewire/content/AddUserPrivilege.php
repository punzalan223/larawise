<?php

namespace App\Livewire\Content;

use App\Models\ModuleGenerator;
use App\Models\UsersPrivileges;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use DB;

class AddUserPrivilege extends Component
{

    use WithPagination;

    public $privilege_data;

    public $search = '';
    public $paginate = 10;
    public $privilege_access_list = [];

    public $add_privilege_name = '';
    public $add_privilege_access = [];
    public $add_status = 'ACTIVE';

    public $edit_privilege_name = '';
    public $edit_status = '';
    public $edit_privilege_access = [];

    public function clearDataProperties()
    {
        $this->reset(['add_privilege_name', 'add_privilege_access', 'add_status', 'add_privilege_access']);
        $this->reset(['edit_privilege_name', 'edit_status', 'privilege_data', 'edit_privilege_access']);
    }

    public function clearMessageSession()
    {
        $this->resetErrorBag();
    }

    public function addPrivilege()
    {
        // Implode the array values separated by commas
        $privileges = implode(',', $this->add_privilege_access);
        
        UsersPrivileges::insert([
            'name' => $this->add_privilege_name,
            'privilege_access_id' => $privileges,
            'status' => $this->add_status,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->clearDataProperties();
        $this->clearMessageSession();

        $this->dispatch('refreshComponent');
        request()->session()->flash('add-success', 'Privilege Created Sucessfully');
    }

    public function editPrivilege()
    {

        $privileges = implode(',', $this->edit_privilege_access);

        UsersPrivileges::find($this->privilege_data->id)
            ->update([
                'name' => $this->edit_privilege_name,
                'privilege_access_id' => $privileges,
                'status' => $this->edit_status,
                'updated_by' => auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
        $this->dispatch('refreshComponent');
        request()->session()->flash('edit-success', 'Privilege Edited Sucessfully');
    }

    public function viewPrivilege($privilegeId)
    {
        $this->privilege_data = UsersPrivileges::find($privilegeId);
        // Explode the comma-separated string into an array
        $this->edit_privilege_access = explode(',', $this->privilege_data->privilege_access_id);
        // $this->edit_privilege_access = explode(',', $this->privilege_data->privilege_access_id);
        $this->edit_privilege_name = $this->privilege_data->name;
        $this->edit_status = $this->privilege_data->status;

        $this->dispatch('view-success', message: $this->edit_privilege_access);
    }

    public function render()
    {
        $data = [];
        $data['modules'] = ModuleGenerator::where('is_active', 1)->get();

        $this->privilege_access_list = ModuleGenerator::where('is_active', 1)->pluck('id');
        $this->privilege_access_list->all();

        $data['privileges'] = UsersPrivileges::query()
            ->leftJoin('users as created_users', 'created_users.id', 'users_privileges.created_by')
            ->leftJoin('users as updated_users', 'updated_users.id', 'users_privileges.updated_by')
            ->select('users_privileges.*', 'created_users.name as created_by', 'updated_users.name as updated_by')
            ->where(function ($query) {
                $query->orWhere('users_privileges.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users_privileges.status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('users_privileges.id', 'asc')
            ->paginate($this->paginate);
    
        return view('livewire.content.add-user-privilege', $data);
    }
}
