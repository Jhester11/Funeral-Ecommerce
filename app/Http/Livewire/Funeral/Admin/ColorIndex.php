<?php

namespace App\Http\Livewire\Funeral\Admin;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class ColorIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    
    public function render()
    {
        $colors = Color::orderBy('id', 'DESC')->paginate(10);
        if (strlen($this->search) > 2) {
            $colors = Color::where('name', 'like', "%{$this->search}%")->paginate(10);
        }
        return view('livewire.funeral.admin.color-index', ['colors'   =>  $colors]);
    }
}
