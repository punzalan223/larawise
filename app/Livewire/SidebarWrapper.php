<?php

namespace App\Livewire;

use App\Models\ModuleGenerator;
use App\Models\User;
use App\Models\UsersAppSetting;
use App\Models\UsersPrivileges;
use Livewire\Attributes\On; 
use Livewire\Component;

class SidebarWrapper extends Component
{
    #[On('refreshComponent')]

    public function mount()
    {
        $this->lw_user = User::find(auth()->user()->id);
    }
    
    public function render()
    {
        $data = [];
        $data['privilege_access'] = UsersPrivileges::where('id', auth()->user()->privilege_id)->first();
        $data['lw_user'] = User::find(auth()->user()->id);;
        $data['app_settings'] = UsersAppSetting::first();
        $data['modules'] = ModuleGenerator::get();

        return view('livewire.sidebar-wrapper', $data);
    }
}
