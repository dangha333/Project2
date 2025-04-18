<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 7); // mặc định là 7
        $query = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as categoryName')->orderBy('id', 'asc')
           ;
            if ($perPage === 'all') {
                $listProduct = $query->paginate(1000000)->withQueryString();
            } else {
                $listProduct = $query->paginate((int) $perPage)->withQueryString();
            }
        return view('products.list', compact('listProduct'));
    }

    public function addProduct()
    {
        $categories = Category::select('id', 'name')->get();
        return view('products.add', compact('categories'));
    }
    public function addPostProduct(Request $request)
    {
        // $product = new Product();
        // $product->name = $request->name;
        // $product->category_id = $request->category;
        // $product->price = $request->price;
        // $product->view = $request->view;
        // $product->save();

        $data = [
            'name' => $request->name,
            'description' =>$request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
        
        ];
        Product::create($data);
        return redirect()->route('listProduct')->with([
            'message' => 'Them san pham thanh cong'
        ]);
    }

    public function updateProduct($id)
    {
        $categories = Category::select('id', 'name')->get();
        $product = Product::where('id', $id)->first();
        return view('products.edit', compact('product', 'categories'));
    }

    public function updatePatchProduct($id, Request $request)
    {
        $product = Product::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' =>$request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'updated_at' => Carbon::now(),
        ];


        $product->update($data);

        return redirect()->route('listProduct')->with([
            'message' => 'Sửa sản phẩm thành công'
        ]);
    }

    public function deleteProduct($id)
    {
        $product = Product::where('id', $id)->first();
       
        $product->delete();
        return redirect()->route('listProduct')->with([
            'message' => 'Xoa pham thanh cong'
        ]);

    }
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.list-products')->with([
            'message' => 'Khôi phục sản phẩm thành công'
        ]);
    }

    public function trashed()
    {
        $trashedProducts = Product::onlyTrashed()->paginate(7);
        return view('admin.products.trashed', compact('trashedProducts'));
    }
    public function forceDelete($id)
{
    $product = Product::withTrashed()->findOrFail($id);
    if ($product->image != null && $product->image != '') {
        Storage::disk('public')->delete($product->image);
    }
    $product->forceDelete();
    return redirect()->route('admin.products.trashed')->with('message', 'Xóa vĩnh viễn sản phẩm thành công');
}
    public function detailProduct($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.products.detail', compact('product'));
    }

  
}
