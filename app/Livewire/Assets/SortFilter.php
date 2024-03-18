<?php

namespace App\Livewire\Assets;

use Livewire\Component;

class SortFilter extends Component
{
    // Define available filter options
    public $filter = [
        'equals' => '=',
        'is_greater_than' => '>',
        'is_greater_than_or_equal_to' => '>=',
        'is_less_than' => '<',
        'is_less_than_or_equal_to' => '<=',
        'null' => 'null',
    ];

    // Define available sort options
    public $sort = ['asc', 'desc'];

    // Array to hold column names
    public $column_names;

    // Arrays to hold filter, input, and sort values for each column
    public $filter_column = [];
    public $input_column = [];
    public $sort_column = [];

    // Array to track whether input and sort fields are disabled for each column
    public $inputSortDisabled = [];

    // Initialize component properties and set default values
    public function mount(){
        $this->defaultFilterData();
    }

    // Render the Livewire component
    public function render()
    {
        // Pass data to the Livewire view
        $data = [
            'filters' => $this->filter,
            'sorts' => $this->sort, 
            'sort_filter_columns' => array_keys($this->column_names),
            'disabled' => $this->inputSortDisabled,
        ];

        return view('livewire.assets.sort-filter', $data);
    }

    // Method to dispatch custom event with filtering and sorting data
    public function filteredData()
    {
        // Dispatching a custom event
        $this->dispatch('sort-filter', 
            message: [
                'filter' => $this->filter_column, // Data related to filtering
                'input' => $this->input_column,   // Data related to input
                'sort' => $this->sort_column,     // Data related to sorting
            ]
        );

    }

    // Clear Filtering
    public function clearFilteredData()
    {
        $this->defaultFilterData();
        // Dispatching a custom event
        $this->dispatch('sort-filter', 
            message: []
        );

    }
    // Method to enable input and sort fields for the selected row/column
    public function enableSelectedRow($column)
    {
        $this->inputSortDisabled[$column] = false;
    }

    public function defaultFilterData()
    {
        $this->input_column = [];
        foreach($this->column_names as $key => $value){
            $this->filter_column[$key] = '';
            $this->sort_column[$key] = '';
            $this->inputSortDisabled [$key] = true; // Initially disable input and sort fields for all columns
        }
    }
}
