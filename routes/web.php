<?php

use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);

Route::get('/categories', CategoriesPage::class);

Route::get('/products', ProductsPage::class);

Route::get('/products/{product}', ProductDetailPage::class);

Route::get('/cart', CartPage::class);

Route::get('/checkout', CheckoutPage::class);

Route::get('/my-orders', MyOrdersPage::class);

Route::get('/my-orders/{order}', MyOrderDetailPage::class);

Route::get('/success', SuccessPage::class);

Route::get('/cancel', CancelPage::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
