<?php

namespace App\Livewire;

use App\Models\ModuleGenerator;
use App\Models\UsersAppSetting;
use Livewire\Component;

class SidebarWrapper extends Component
{
    protected $listeners = ['module-added' => 'moduleAdded'];

    public function render()
    {
        $data = [];
        $data['app_settings'] = UsersAppSetting::first();
        $data['modules'] = ModuleGenerator::get();

        return view('livewire.sidebar-wrapper', $data);
    }
}
