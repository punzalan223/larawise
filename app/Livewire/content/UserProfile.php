<?php

namespace App\Livewire\Content;

use App\Models\User;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\WithSorting;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserProfile extends Component
{
    public $user_id = '';

    public $auth_user_information = '';

    // Edit User
    public $e_first_name = '';
    public $e_last_name = '';
    public $e_contact = '';
    public $e_email = '';
    public $e_password = '';
    public $e_password_confirmation = '';

    public function editUser()
    {
        $rules = [
            'e_first_name' => 'required',
            'e_last_name' => 'required',
            'e_contact' => 'required',
            'e_email' => 'required|email',
        ];

        // Check uniqueness of email only if it's different from the current user's email
        if ($this->e_email !== $this->auth_user_information->email) {
            $rules['e_email'] .= '|unique:users';
        }

        if($this->e_password){
            $rules['e_password'] = 'required|min:4|confirmed';
        }

        $this->validate($rules);


        User::find($this->user_id)
            ->update([
                'first_name' => $this->e_first_name,
                'last_name' => $this->e_last_name,
                'email' => $this->e_email,
                'contact' => $this->e_contact,
            ]);

        if($this->e_password){
            User::find($this->user_id)->update([
                "password" => Hash::make($this->e_password)
            ]);
        }

        $this->dispatch('edit-success');
    }

    public function render()
    {
        $auth_id = auth()->user()->id;

        $data = [];
        $data['user'] = User::find($auth_id);

        $this->user_id = $data['user']->id;
        $this->auth_user_information = $data['user'];

        $this->e_first_name = $data['user']->first_name;
        $this->e_last_name = $data['user']->last_name;
        $this->e_contact = $data['user']->contact;
        $this->e_email = $data['user']->email;

        return view('livewire.content.user-profile', $data);
    }
}
