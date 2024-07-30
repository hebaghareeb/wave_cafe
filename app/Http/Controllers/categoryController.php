<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories',['categories' => $categories]);
    }
    public function createCategory(Request $request)
    {
        if($request->has('cancel'))
        return redirect('categories');
    else if($request->has('add'))
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('categories');
    }
 }
    public function deleteCategory(string $id)
    {
        Category::where('id',$id)->delete();
        return redirect('categories');
    }
    public function editcategory(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editCategory',['category'=> $category]);
    }
    public function updateCategory(Request $request,string $id)
    {
        if($request->has('cancel'))
            return redirect('categories');
        else if($request->has('update'))
        {
             Category::where('id',$id)->update(['name' => $request->name]);
              return redirect('categories');
        }
    }
}
