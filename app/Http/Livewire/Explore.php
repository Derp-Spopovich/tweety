<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Explore extends Component
{
    public function render()
    {
        return view('livewire.explore')
            ->layout('components.app');
    }
}
