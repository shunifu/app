<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Topics extends Component
{

    public $states;
    public $cities;

    public $selectedState = NULL;

    public function mount()
    {
        $this->states = DemoState::all();
        $this->cities = collect();
    }
    public function render()
    {
        return view('livewire.topics');
    }
}
