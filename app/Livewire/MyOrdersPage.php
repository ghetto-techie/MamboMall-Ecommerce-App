<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MyOrdersPage extends Component
{
    public function render()
    {
        return view('livewire.my-orders-page');
    }
}
