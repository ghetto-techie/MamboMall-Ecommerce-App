<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Products')]
class MyOrdersPage extends Component
{
    use WithPagination;
    public function render()
    {
        $userId = Auth::user()->id;
        $userOrders = Order::query()->where('user_id', $userId);
        return view('livewire.my-orders-page', [
            'userOrders' => $userOrders->paginate(15)->withQueryString()
        ]);
    }
}
