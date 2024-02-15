<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{

    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $count = 0;

    public function createNewUser()
    {

        $this->count+=1;

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        User::create([
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password
        ]);

        $this->reset(['name', 'email', 'password']);

        request()->session()->flash('success', 'User Created Sucessfully');
    }

    public function render()
    {

        $data = [];
        $data['title'] = 'Login';
        $data['users'] = User::paginate(5);

        return view('livewire.clicker', $data);
    }
}
