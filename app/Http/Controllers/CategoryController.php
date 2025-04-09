<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        return view('categories.list', compact('categories'));
    }

    public function addCategory()
    {

        return view('categories.add');
    }
    public function addPostCategory(Request $request)
    {

        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
        
        ];
        Category::create($data);
        return redirect()->route('listCategory')->with([
            'message' => 'Thêm danh mục thành công'
        ]);
    }

    public function updateCategory($id)
    {
        $category = Category::where('id', $id)->first();
        return view('categories.edit', compact('category'));
    }

    public function updatePatchCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $data = [
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ];


        $category->update($data);

        return redirect()->route('listCategory')->with([
            'message' => 'Sửa danh mục thành công'
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::where('id', $id)->first();
       
        $category->delete();
        return redirect()->route('listCategory')->with([
            'message' => 'Xóa danh mục thành công'
        ]);

    }
  
}
