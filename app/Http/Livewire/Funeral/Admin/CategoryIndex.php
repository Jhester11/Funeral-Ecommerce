<?php

namespace App\Http\Livewire\Funeral\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CategoryIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    
    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        if (strlen($this->search) > 2) {
            $categories = Category::where('name', 'like', "%{$this->search}%")->paginate(10);
        }
        return view('livewire.funeral.admin.category-index', ['categories' => $categories]);
    }
}
