<?php

namespace App\Livewire\Content;

use App\Models\User;
use App\Models\UsersAppSetting;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\WithSorting;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserProfile extends Component
{
    use WithFileUploads;

    public $user_id = '';

    public $auth_user_information = '';

    // Edit User
    public $e_first_name = '';
    public $e_last_name = '';
    public $e_contact = '';
    public $e_email = '';
    public $e_password = '';
    public $e_password_confirmation = '';
    public $e_img;

    public function clearDataProperties(){
        $this->reset(['e_password', 'e_password_confirmation', 'e_img']);
    }

    public function editUser()
    {
        // dd($this->e_img);
        $user = User::find($this->user_id);
        $message = 'Updated Successfully';
        $rules = [
            'e_first_name' => 'required',
            'e_last_name' => 'required',
            'e_contact' => 'required',
            'e_email' => 'required|email',
        ];

        if ($this->e_email !== $this->auth_user_information->email) {
            $rules['e_email'] .= '|unique:users';
        }

        if($this->e_password || $this->e_password_confirmation){
            $rules['e_password'] = 'required|min:4|confirmed';
            $rules['e_password_confirmation'] = 'required';
        }

        if($this->e_img){
            $rules['e_img'] =  'image|max:1024';
        }

        $this->validate($rules);

        $user->find($this->user_id)
            ->update([
                'first_name' => $this->e_first_name,
                'last_name' => $this->e_last_name,
                'email' => $this->e_email,
                'contact' => $this->e_contact,
            ]);

        if($this->e_password){
            $user->find($this->user_id)->update([
                "password" => Hash::make($this->e_password)
            ]);
        }

        if ($this->e_img) {
            // Get the client extension of the uploaded photo
            $extension = 'png';
        
            // Construct a unique file name based on user ID and first name
            $first_name = $this->auth_user_information->first_name;
            $file_name = "$this->user_id-$first_name.$extension";

            $user->update(['img' => $file_name]);
            
            // Store the uploaded photo in the public directory
            $this->e_img->storePubliclyAs("img/user-profiles", $file_name, 'public');

            $message = 'Profile image updated successfully.';
        }

        $this->dispatch('refreshComponent', message: $message);
    }

    public function render()
    {
        $auth_id = auth()->user()->id;

        $data = [];
        $data['user'] = User::find($auth_id);
        $data['app_settings'] = UsersAppSetting::first();

        if($data['user']){
            $this->user_id = $data['user']->id;
            $this->auth_user_information = $data['user'];

            $this->e_first_name = $data['user']->first_name;
            $this->e_last_name = $data['user']->last_name;
            $this->e_contact = $data['user']->contact;
            $this->e_email = $data['user']->email;
        }


        return view('livewire.content.user-profile', $data);
    }
}
