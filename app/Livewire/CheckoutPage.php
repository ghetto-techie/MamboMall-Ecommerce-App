<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Services\PayHeroService; // 👈 Import the service
use Filament\Forms\Components\Livewire;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Layout('layouts.app')]
#[Title('Checkout')]
class CheckoutPage extends Component
{
    #[Rule('required|string|max:50')]
    public $first_name;

    #[Rule('required|string|max:50')]
    public $last_name;

    #[Rule('required|string|max:20')]
    public $phone;

    #[Rule('nullable|email')]
    public $email;

    #[Rule('required|string')]
    public $street_address;

    #[Rule('required|string')]
    public $city;

    #[Rule('required|string')]
    public $county;

    #[Rule('nullable|string')]
    public $zip;

    #[Rule('required|in:mpesa,cash_on_delivery')]
    public $payment_method;
    #[Rule('required_if:payment_method,mpesa|string|max:20')]
    public $mpesa_phone;
    public $country = 'Kenya';
    public $delivery_note;

    // Tax configuration
    public $taxRate = 0; // Use fraction for rate e.g. 0.16 for 16% VAT in Kenya
    public $taxAmount = 0;
    public $subtotal = 0;
    public $shipping = 0; // Free shipping
    public $grandTotal = 0;

    public function placeOrder()
    {
        $this->validate();
        $cartItems = CartManagement::getCartItemsFromCookie();
        $this->calculateTotals($cartItems);

        DB::transaction(function () use ($cartItems) {
            $order = Order::create([
                'user_id'        => Auth::id(),
                'status'         => Order::STATUS_NEW,
                'grand_total'    => $this->grandTotal,
                'currency'       => 'KES',
                'notes'          => $this->delivery_note,
                'payment_method' => $this->payment_method,
                'payment_status' => Order::PAYMENT_STATUS_PENDING
            ]);

            $order->address()->create([
                'first_name'     => $this->first_name,
                'last_name'      => $this->last_name,
                'phone'          => $this->phone,
                'city'           => $this->city,
                'county'         => $this->county,
                'zip_code'       => $this->zip,
                'street_address' => $this->street_address
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id'   => $item['product_id'],
                    'quantity'     => $item['quantity'],
                    'unit_amount'  => $item['unit_amount'],
                    'total_amount' => $item['total_amount']
                ]);
            }

            if ($this->payment_method === 'mpesa') {
                $payhero = app(PayHeroService::class);

                $response = $payhero->sendStkPush(
                    $this->grandTotal,
                    $this->mpesa_phone,
                    'ORD-' . $order->id,
                    $this->first_name . ' ' . $this->last_name
                );

                if (isset($response['status']) && $response['status'] === 'error') {
                    LivewireAlert::error()->title('Payment Failed')->text($response['message'] ?? 'Unknown error')->timer(5500)->show();
                } elseif (isset($response['success']) && $response['success'] === true) {
                    LivewireAlert::success()->title('Payment initiated!')->text('Check your phone to complete.')->show();
                      CartManagement::clearCartItemsFromCookie();
                } else {
                    LivewireAlert::error()->title('Unexpected payment response')->text(json_encode($response))->show();
                }
            } elseif ($this->payment_method === 'cash_on_delivery') {
                LivewireAlert::success()->title('Order placed!')->text('Please pay cash on delivery.')->show();
                CartManagement::clearCartItemsFromCookie();
            }
        });
    }

    private function calculateTotals($cartItems)
    {
        $this->subtotal = CartManagement::calculateGrandTotalItems($cartItems);
        $this->taxAmount = $this->subtotal * $this->taxRate;
        $this->grandTotal = $this->subtotal + $this->taxAmount + $this->shipping;
    }

    public function mount()
    {
        // Pre-fill user data if authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone = $user->phone;
        }
        
        // Calculate initial totals
        $cartItems = CartManagement::getCartItemsFromCookie();
        $this->calculateTotals($cartItems);
    }

    public function render()
    {
        $cartItems = CartManagement::getCartItemsFromCookie();
        return view('livewire.checkout-page', [
            'cartItems' => $cartItems,
            'subtotal' => $this->subtotal,
            'taxAmount' => $this->taxAmount,
            'shipping' => $this->shipping,
            'grandTotal' => $this->grandTotal,
            'taxRate' => $this->taxRate * 100
        ]);
    }
}