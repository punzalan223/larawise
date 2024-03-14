<?php

namespace App\Livewire\Content;

use App\Models\User;
use App\Models\UsersPrivileges;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;

class AddUser extends Component
{
    use WithPagination;

    public $columns = ['name', 'first_name', 'last_name', 'contact', 'email', 'status', 'created_at'];

    public $editUserData;
    
    #[Url]
    public $search = '';
    public $paginate = 10;

    // Add user
    public $first_name = '';
    public $last_name = '';
    public $contact = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $privilege_id = '';

    // Edit User
    public $e_first_name = '';
    public $e_last_name = '';
    public $e_contact = '';
    public $e_email = '';
    public $e_password = '';
    public $e_password_confirmation = '';
    public $e_privilege_id = '';

    // userId
    public $userId = '';

    public function search()
    {
        $this->resetPage();
    }

    public function resetUserData()
    {
        $this->editUserData = [];
        $this->userId = '';
    }

    public function clearDataProperties()
    {
        $this->reset(['first_name', 'last_name', 'contact', 'email', 'password', 'password_confirmation', 'privilege_id']);
        $this->reset(['e_first_name', 'e_last_name', 'e_contact', 'e_email', 'e_password', 'e_password_confirmation', 'e_privilege_id']);
        $this->resetErrorBag();
    }
    

    public function addUser()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
            'privilege_id' => 'required'
        ]);

        User::create([
            "name" => $this->first_name.' '.$this->last_name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "contact" => $this->contact,
            "email" => $this->email,
            "password" => Hash::make($this->password),
            'privilege_id' => $this->privilege_id,
            "status" => 'ACTIVE',
        ]);

        $this->clearDataProperties();

        request()->session()->flash('add-success', 'User Created Sucessfully');
    }

    public function editUser()
    {
        $rules = [
            'e_first_name' => 'required',
            'e_last_name' => 'required',
            'e_contact' => 'required',
            'e_email' => 'required|email',
            'e_privilege_id' => 'required'
        ];
    
        // Check uniqueness of email only if it's different from the current user's email
        if ($this->e_email !== $this->editUserData->email) {
            $rules['e_email'] .= '|unique:users';
        }

        if($this->e_password || $this->e_password_confirmation){
            $rules['e_password'] = 'required|min:4|confirmed';
            $rules['e_password_confirmation'] = 'required';
        }
        
        $this->validate($rules);
    
        User::find($this->userId)->update([
            "name" => $this->e_first_name.' '.$this->e_last_name,
            "first_name" => $this->e_first_name,
            "last_name" => $this->e_last_name,
            "contact" => $this->e_contact,
            "email" => $this->e_email,
            "updated_by" => auth()->user()->id,
            "updated_at" => date('Y-m-d H:i:s'),
            'privilege_id' => $this->e_privilege_id,
        ]);

        if($this->e_password){
            User::find($this->userId)->update([
                "password" => Hash::make($this->e_password)
            ]);

            $this->reset(['e_password', 'e_password_confirmation']);
        }

        request()->session()->flash('edit-success', 'User Updated Successfully');
    }

    public function inactiveUser($userId){
        User::find($userId)->update(['status' => 'INACTIVE']);
    }

    public function activeUser($userId){
        User::find($userId)->update(['status' => 'ACTIVE']);
    }

    public function viewUser($userId)
    {
        $this->editUserData = User::find($userId);
        $this->userId = $userId;
    
        if ($this->editUserData) {
            $this->e_first_name = $this->editUserData->first_name;
            $this->e_last_name = $this->editUserData->last_name;
            $this->e_contact = $this->editUserData->contact;
            $this->e_email = $this->editUserData->email;
            $this->e_privilege_id = $this->editUserData->privilege_id;
        }
    }

    public function render()
    {

        $data = [];
        $data['columns'] = $this->columns;
        $data['users'] = User::query();
        foreach($data['columns'] as $column){
            $data['users']->orWhere($column, 'like', '%' . $this->search . '%');
        }
        $data['users'] = $data['users']
        ->orderBy('id', 'asc')
        ->paginate($this->paginate);

        $data['privileges'] = UsersPrivileges::get();

        return view('livewire.content.add-user', $data);
    }
}
