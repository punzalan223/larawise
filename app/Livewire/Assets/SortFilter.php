<?php

namespace App\Livewire\Assets;

use Livewire\Component;

class SortFilter extends Component
{
    public $filter = ['equals' => '=',
        'is_greater_than' => '>',
        'is_greater_than_or_equal_to' => '>=',
        'is_less_than' => '<',
        'is_less_than_or_equal_to' => '<=',
        'equal' => '!=',
        'null' => '',
    ];
    public $sort = ['asc', 'desc'];
    public $column_names;

    public function render()
    {
        $data = [];
        $data['filters'] = $this->filter;
        $data['sorts'] = $this->sort;
        $data['sort_filter_columns'] = $this->column_names;
        return view('livewire.assets.sort-filter', $data);
    }
}
