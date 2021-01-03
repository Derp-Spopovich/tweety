<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Search extends Component
{
    public $search;

    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.search', [
            'users' => User::where('name', 'like', '%'.$this->search.'%')->latest()->paginate(10),
        ]);
    }
}
