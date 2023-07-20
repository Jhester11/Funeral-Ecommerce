<?php

namespace App\Http\Controllers\Funeral\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist()
    {
        return view('funeral.wishlist.wishlist');
    }
}
