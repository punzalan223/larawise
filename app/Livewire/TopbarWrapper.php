<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UsersAppSetting;
use Livewire\Component;

class TopbarWrapper extends Component
{
    public function render()
    {
        $data = [];
        $data['ls_user'] = User::where('users.id', auth()->user()->id)
            ->leftJoin('users_privileges', 'users_privileges.id', 'users.id')
            ->select('users.*', 
                'users_privileges.name as privilege_name')
            ->first();
        $data['app_settings'] = UsersAppSetting::first();

        return view('livewire.topbar-wrapper', $data);
    }
}
