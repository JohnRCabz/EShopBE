<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(Request $request)
    {
        return $this->cartService->addItemToCart($request);
    }

    public function view()
    {
        return $this->cartService->viewCart();
    }

    public function remove($id)
    {
        return $this->cartService->removeItemFromCart($id);
    }

    public function checkout()
    {
        return $this->cartService->checkout();
    }
}