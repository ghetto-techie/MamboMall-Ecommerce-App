<?php

use App\Http\Controllers\ContactController;
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
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/categories', CategoriesPage::class)->name('categories');

Route::get('/products', ProductsPage::class)->name('products');

Route::get('/products/{slug}', ProductDetailPage::class)->name('product.detail');

Route::get('/cart', CartPage::class)->name('cart');

Route::get('/success', SuccessPage::class)->name('success');

Route::get('/cancel', CancelPage::class)->name('cancel');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/my-orders', MyOrdersPage::class)->name('user.orders');

    Route::get('/my-orders/{order}', MyOrderDetailPage::class)->name('user.order.detail');

    Route::get('/checkout', CheckoutPage::class)->name('checkout');
});

// Add this to your web.php routes file
Route::get('/test-email', function () {
    try {
        Mail::raw('This is a test email', function ($message) {
            $message->to('test@example.com')
                    ->subject('Test Email');
        });
        return 'Email sent successfully! Check MailHog.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
