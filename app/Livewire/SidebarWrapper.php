<?php

namespace App\Livewire;

use App\Models\ModuleGenerator;
use App\Models\UsersAppSetting;
use App\Models\UsersPrivileges;
use Livewire\Component;

class SidebarWrapper extends Component
{
    protected $listeners = [
        'module-added' => 'moduleAdded',
        'edit-success' => 'profileUpdated'
    ];

    public function render()
    {
        $data = [];
        $data['privilege_access'] = UsersPrivileges::where('id', auth()->user()->privilege_id)->first();
        
        $data['app_settings'] = UsersAppSetting::first();
        $data['modules'] = ModuleGenerator::get();
        
        return view('livewire.sidebar-wrapper', $data);
    }
}
