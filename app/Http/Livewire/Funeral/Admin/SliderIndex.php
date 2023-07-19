<?php

namespace App\Http\Livewire\Funeral\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class SliderIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    
    public function render()
    {
        $sliders = Slider::orderBy('id', 'ASC')->paginate(10);
        if (strlen($this->search) > 2) {
            $sliders = Slider::where('title', 'like', "%{$this->search}%")->paginate(10);
        }
        return view('livewire.funeral.admin.slider-index', ['sliders' => $sliders]);
    }
}
