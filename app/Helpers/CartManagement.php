<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class CartManagement
{
    // Add item to cart
    public static function addItemToCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            // If item already exists, increment quantity
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
            LivewireAlert::title('Cart Updated')
                ->success()
                ->timer(4000)
                ->position('top-end')
                ->toast()    
                ->show();
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);

            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0],
                    'unit_amount' => $product->price,
                    'quantity' => 1,
                    'total_amount' => $product->price,
                ];
            LivewireAlert::title('Product Added to Cart')
                ->success()
                ->timer(4000)
                ->show();
            }
        }

        self::addCartItemToCookie($cart_items);
        return count($cart_items);
    }

    // Remove item from cart
    public static function removeItemFromCart($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    // Add cart item to cookie
    public static function addCartItemToCookie($cartItems)
    {
        Cookie::queue("cart_items", json_encode($cartItems), 60 * 24 * 30); // Store for 30 days
    }

    // Clear cart items from cookie
    public static function clearCartItemsFromCookie()
    {
        Cookie::queue(Cookie::forget("cart_items"));
    }

    // Get all cart items from cookie
    public static function getCartItemsFromCookie()
    {
        $cartItems = Cookie::get("cart_items");
        return $cartItems ? json_decode($cartItems, true) : [];
    }

    // Increment item quantity in cart
    public static function incrementCartItemQuantity($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }
        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    // Decrement item quantity in cart
    public static function decrementCartItemQuantity($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']--;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                break;
            }
        }
        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    // Calculate grand total items in cart
    public static function calculateGrandTotalItems($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}