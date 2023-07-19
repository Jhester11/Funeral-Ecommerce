<?php

namespace App\Http\Controllers\Funeral\Admin;

use Alert;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    // User interface for slider
    public function slider()
    {
        $sliders = Slider::all();
        return view('funeral.admin.slider.slider', compact('sliders'));
    }

    // Form for slider
    public function create()
    {
        return view('funeral.admin.slider.create');
    }

    // Storing data in database
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/sliders')->withSuccess('Slider Added Successfully');
    }

    // Fetching the data and edit
    public function edit(Slider $slider)
    {
        return view('funeral.admin.slider.edit', compact('slider'));
    }

    // Updating the data and save in database
    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        if($request->hasFile('image')){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::exists($destination);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider', $filename);
            $validatedData['image'] = "uploads/slider/$filename";
        }
        $validatedData['status'] = $request->status == true ? '1':'0';
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status'],
        ]);
        return redirect('admin/sliders')->withSuccess( 'Slider Updated Successfully');
    }

    // Deleting data in database
    public function destroy(Slider $slider)
    {
        if($slider->count() > 0) {
            $destination = $slider->image;
            if(File::exists($destination)){
                File::exists($destination);
            }
            $slider->delete();
            return redirect('admin/sliders')->withSuccess('Slider Deleted Successfully');
        }
        return redirect('admin/sliders')->withWarning( 'Something went wrong');
    }
}
