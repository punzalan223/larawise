<?php

namespace App\Livewire\Content;

use App\Models\ModuleGenerator;
use App\Models\UsersPrivileges;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class AddUserPrivilege extends Component
{

    use WithPagination;

    public $privilege_data;

    public $search = '';
    public $paginate = 10;

    public $add_privilege_name = '';
    public $add_privilege_access = '';
    public $add_status = 'ACTIVE';

    public $edit_privilege_name = '';
    public $edit_status = '';

    public function clearDataProperties()
    {
        $this->reset(['add_privilege_name', 'add_privilege_access', 'add_status']);
        $this->reset(['edit_privilege_name', 'edit_status', 'privilege_data']);
    }

    public function clearMessageSession()
    {
        $this->resetErrorBag();
    }

    public function addPrivilege()
    {
        dd($this->add_privilege_access);
        UsersPrivileges::insert([
            'name' => $this->add_privilege_name,
            'status' => $this->add_status,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->clearDataProperties();
        $this->clearMessageSession();

        request()->session()->flash('add-success', 'Privilege Created Sucessfully');
    }

    public function editPrivilege()
    {
        UsersPrivileges::find($this->privilege_data->id)
            ->update([
                'name' => $this->edit_privilege_name,
                'status' => $this->edit_status,
                'updated_by' => auth()->user()->id,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        request()->session()->flash('edit-success', 'Privilege Edited Sucessfully');
        
    }

    public function viewPrivilege($privilegeId)
    {
        $this->privilege_data = UsersPrivileges::find($privilegeId);
        $this->edit_privilege_name = $this->privilege_data->name;
        $this->edit_status = $this->privilege_data->status;
    }

    public function render()
    {
        $data = [];
        $data['modules'] = ModuleGenerator::where('is_active', 1)->get();
        
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
