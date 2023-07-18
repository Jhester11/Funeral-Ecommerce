<?php

namespace App\Http\Controllers\Funeral\Admin;

use Alert;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryFormRequest;


class CategoryController extends Controller
{
    // For Displaying the data
    public function category()
    {
        return view('funeral.admin.category.category');
    }

    // Form of creating a data
    public function create()
    {
        return view('funeral.admin.category.create');
    }

    // Storing data in database
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }

        $category->status = $request->status == true ? '1' : '0';
        $category->save();
        return redirect('admin/category')->withSuccess('Category Added Successfully!');
    }

    // Showing the data that will edit
    public function edit(Category $category)
    {
        return view('funeral.admin.category.edit', compact('category'));
    }

    // Updating the new data and it will store in database the latest
    public function update(CategoryFormRequest $request, $category)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($category);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $path = 'uploads/category/' . $category->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/category/', $filename);
            $category->image = $uploadPath . $filename;
        }


        $category->status = $request->status == true ? '1' : '0';
        $category->update();
        return redirect('admin/category')->withSuccess('Category Updated Successfully!');
    }

    // Deleting data in database
    public function destroy(Category $category)
    {
        if($category->count() > 0) {
            $destination = $category->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $category->delete();
            return redirect('admin/category');
        }
        return redirect('admin/category')->withInfo('Something went wrong!');
    }
}
