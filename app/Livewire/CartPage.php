<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Cart')]
class CartPage extends Component
{
    public $cart_items = [];
    public $grandTotal = 0;
    public $subtotal = 0;
    public $taxRate = 0.15; // 15% tax rate
    public $taxAmount = 0;
    public $discount = 0;
    public $couponCode = '';
    public $itemCount = 0;
    public $couponError = '';
    public $couponSuccess = '';
    public $appliedCoupon = null;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->calculateTotals();
        $this->loadSavedCoupon();
    }

    private function loadSavedCoupon()
    {
        if ($couponCode = session('applied_coupon')) {
            $this->couponCode = $couponCode;
            $this->applyCoupon();
        }
    }

    public function render()
    {
        return view('livewire.cart-page', [
            'cart_items' => $this->cart_items,
            'grandTotal' => $this->grandTotal,
            'itemCount' => $this->itemCount,
            'subtotal' => $this->subtotal,
            'taxAmount' => $this->taxAmount,
        ]);
    }

    private function calculateTotals()
    {
        $this->itemCount = count($this->cart_items);
        $this->subtotal = CartManagement::calculateGrandTotalItems($this->cart_items);
        $this->taxAmount = $this->subtotal * $this->taxRate;
        
        // Apply coupon discount if exists
        $this->grandTotal = $this->subtotal + $this->taxAmount - $this->discount;
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeItemFromCart($product_id);
        $this->calculateTotals();
        $this->validateCoupon();
    }

    public function increaseQuantity($product_id)
    {
        $this->cart_items = CartManagement::incrementCartItemQuantity($product_id);
        $this->calculateTotals();
        $this->validateCoupon();
    }

    public function decreaseQuantity($product_id)
    {
        $this->cart_items = CartManagement::decrementCartItemQuantity($product_id);
        $this->calculateTotals();
        $this->validateCoupon();
    }

    public function clearCart()
    {
        CartManagement::clearCartItemsFromCookie();
        $this->cart_items = [];
        $this->couponCode = '';
        $this->discount = 0;
        $this->appliedCoupon = null;
        session()->forget('applied_coupon');
        $this->couponError = '';
        $this->couponSuccess = '';
        $this->calculateTotals();
    }

    public function applyCoupon()
    {
        $this->couponError = '';
        $this->couponSuccess = '';
        $this->discount = 0;

        if (!$this->couponCode) {
            $this->couponError = 'Please enter a coupon code';
            return;
        }

        $coupon = Coupon::where('code', $this->couponCode)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first();

        if (!$coupon) {
            $this->couponError = 'Invalid or expired coupon code';
            return;
        }

        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            $this->couponError = 'This coupon has reached its usage limit';
            return;
        }

        if ($coupon->min_order && $this->subtotal < $coupon->min_order) {
            $this->couponError = 'Minimum order amount not reached';
            return;
        }

        // Calculate discount
        if ($coupon->type === 'fixed') {
            $this->discount = min($coupon->value, $this->subtotal);
        } else {
            $discountValue = $this->subtotal * ($coupon->value / 100);
            $this->discount = $coupon->max_discount 
                ? min($discountValue, $coupon->max_discount)
                : $discountValue;
        }

        $this->appliedCoupon = $coupon;
        $this->couponSuccess = 'Coupon applied successfully!';
        session()->put('applied_coupon', $coupon->code);
        $this->calculateTotals();
    }

    public function removeCoupon()
    {
        $this->couponCode = '';
        $this->discount = 0;
        $this->appliedCoupon = null;
        $this->couponError = '';
        $this->couponSuccess = '';
        session()->forget('applied_coupon');
        $this->calculateTotals();
    }

    private function validateCoupon()
    {
        if ($this->appliedCoupon) {
            $this->applyCoupon();
        }
    }
}