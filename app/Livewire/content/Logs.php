<?php

namespace App\Livewire\Content;

use App\Models\UserLog;

use Livewire\Component;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;

    public $search = '';
    public $paginate = 10;

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = [];
        $data['user_logs'] = UserLog::query()
        ->leftJoin('users as created_users', 'created_users.id', 'user_logs.id_users')
        ->select('user_logs.*', 'created_users.name as created_by')
        ->where(function ($query){
            $query->orWhere('created_users.name', 'like', '%' . $this->search . '%');
            $query->orWhere('description', 'like', '%' . $this->search . '%');
            $query->orWhere('ip_address', 'like', '%' . $this->search . '%');
            $query->orWhere('description', 'like', '%' . $this->search . '%');
            $query->orWhere('user_logs.created_at', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'asc')
        ->paginate($this->paginate);
    
        return view('livewire.content.logs', $data);
    }
}
