<?php

namespace App\Livewire;

use App\Models\UsersAppSetting;
use Livewire\Component;

class TopbarWrapper extends Component
{
    public function render()
    {
        $data = [];
        $data['app_settings'] = UsersAppSetting::first();

        return view('livewire.topbar-wrapper', $data);
    }
}
