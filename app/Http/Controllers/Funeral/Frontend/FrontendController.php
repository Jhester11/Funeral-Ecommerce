<?php

namespace App\Http\Controllers\Funeral\Frontend;

use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    // Home Displaying Products
    public function home()
    {
        $sliders = Slider::where('status', '0')->get();
        $newArrivalsProducts = Product::latest()->take(16)->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();
        return view('funeral.user.home', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'featuredProducts'));
    }
}
