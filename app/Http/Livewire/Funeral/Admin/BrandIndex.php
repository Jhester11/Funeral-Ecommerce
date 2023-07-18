<?php

namespace App\Http\Livewire\Funeral\Admin;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class BrandIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public  $editMode = false;
    public $delete_id, $brandId;
    public $name, $slug, $status, $brand_id, $category_id;
    protected $listeners = ['deleteConfirmed' => 'destroyBrand'];
    
    // *************************Rules for input field**********************************
    protected function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable',
        ];
    }

    // ***************************Input Fields************************************
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    // ******************************Storing data in database***********************
    public function storeBrand()
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('swal:store', [
            'type' => 'success',
            'title' => 'Brand successfully added.',
            'text' => '',
        ]);
        $this->dispatchBrowserEvent('modal', ['modalId' => '#brandModal', 'actionModal' => 'hide']);
    }
    // *******************Showing edit modal and fetching the data**********
    public function showEditModal($id)
    {
        $this->reset();
        $this->brandId = $id;
        $this->loadBrand();
        $this->editMode = true;
        $this->dispatchBrowserEvent('modal', ['modalId' => '#brandModal', 'actionModal' => 'show']);
    }

    // **************Load the Brand by calling the function of loadBrand that stack in id******
    public function loadBrand()
    {
        $brands = Brand::find($this->brandId);
        $this->category_id = $brands->category_id;
        $this->name = $brands->name;
        $this->slug = $brands->slug;
        $this->status = $brands->status;
    }

    // *************************Update the data in database****************************
    public function updateBrand()
    {
        $validated = $this->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ]);
        $brands = Brand::find($this->brandId);
        $brands->update($validated);
        $this->reset();
        $this->dispatchBrowserEvent( 'swal:update', [
            'type' => 'success',
            'title' => 'Brand successfully updated.',
            'text' => '',
        ]);
        $this->dispatchBrowserEvent('modal', ['modalId' => '#brandModal', 'actionModal' => 'hide']);
    }

    // *******************************Delete the data in database************************************
    public function deleteBrand(int $id)
    {
        $brands = Brand::findOrFail($id);
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function destroyBrand()
    {
        $brands = Brand::where('id', $this->delete_id)->delete();
        $this->dispatchBrowserEvent('brandDelete');
    }

    // ****************************Show Brand modal****************************
    public function showBrandModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#brandModal', 'actionModal' => 'show']);
    }
    // *****************************Close Modal************************************
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#brandModal', 'actionModal' => 'hide']);
    }

     // *******************************For rendering the data************************
    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        if (strlen($this->search) > 2) {
            $brands = Brand::where('name', 'like', "%{$this->search}%")->paginate(10);
        }
        return view('livewire.funeral.admin.brand-index', [
            'brands'   =>  $brands, 'categories' => $categories
        ])
        ->extends('layouts.admin.admin-app')
        ->section('content');
    }
}
