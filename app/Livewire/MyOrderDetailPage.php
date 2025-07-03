<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MyOrderDetailPage extends Component
{
    public function render()
    {
        return view('livewire.my-order-detail-page');
    }
}
