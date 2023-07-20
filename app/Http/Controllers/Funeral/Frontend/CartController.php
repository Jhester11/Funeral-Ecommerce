<?php

namespace App\Http\Controllers\Funeral\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('funeral.cart.cart');
    }
}
