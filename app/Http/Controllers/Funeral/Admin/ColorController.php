<?php

namespace App\Http\Controllers\Funeral\Admin;

use Alert;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    // User Interface
    public function color()
    {
        $colors = Color::all();
        return view('funeral.admin.color.color', compact('colors'));
    }

    // Form
    public function create()
    {
        return view('funeral.admin.color.create');
    }

    // Storing data in database
    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::create($validatedData);
        return redirect('admin/colors')->withSuccess('Color Added Successfully');
    }

    // Edit Color Page
    public function edit(Color $color)
    {
        return view('funeral.admin.color.edit', compact('color'));
    }

    // Update Color
    public function update(ColorFormRequest $request, $color_id)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::find($color_id)->update($validatedData);
        return redirect('admin/colors')->withSuccess('Color Updated Successfully');
    }

    // Deleting Data in database
    public function destroy($color_id)
    {
        $color = Color::findOrFail($color_id);
        $color->delete();
        return redirect('admin/colors')->withSuccess('Color Deleted Successfully');
    }
}
