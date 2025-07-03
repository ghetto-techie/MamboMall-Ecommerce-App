<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CartPage extends Component
{
    public function render()
    {
        return view('livewire.cart-page');
    }
}
