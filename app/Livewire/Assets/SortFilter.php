<?php

namespace App\Livewire\Assets;

use Livewire\Component;

class SortFilter extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.assets.sort-filter');
    }
}
