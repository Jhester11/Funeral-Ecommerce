<?php

namespace App\Http\Controllers\Funeral\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{

    // Search Products
    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->paginate(10);
            return view('funeral.pages.search',compact('searchProducts'));
        } else {
            return redirect()->back()->with('meassage', 'Empty Search');
        }
    }

    // Home Displaying Products
    public function home()
    {
        $sliders = Slider::where('status', '0')->get();
        $newArrivalsProducts = Product::latest()->take(16)->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();
        return view('funeral.user.home', compact('sliders', 'trendingProducts', 'newArrivalsProducts', 'featuredProducts'));
    }

    // Featuring category
    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('funeral.collections.category.categories', compact('categories'));
    }

    // New Arrival
    public function newArrival()
    {
        $newArrivalsProducts = Product::latest()->take(16)->get();
        return view('funeral.pages.new-arrival', compact('newArrivalsProducts'));
    }

    // Featured Products
    public function featuredProducts()
    {
        $featuredProducts = Product::where('featured', '1')->latest()->get();
        return view('funeral.pages.featured-products', compact('featuredProducts'));
    }

    // Getting Products by category
    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            // $products = $category->products()->get();
            return view('funeral.collections.product.products', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    // For Product Viewing
    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {
            $products = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($products) {
                return view('funeral.collections.product.view', compact('products', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

}
