<?php

namespace App\Http\Livewire\Funeral\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        if (strlen($this->search) > 2) {
            $products = Product::where('name', 'like', "%{$this->search}%")->paginate(10);
        }
        return view('livewire.funeral.admin.product-index', ['products'   =>  $products]);
    }
}
