<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.index', compact('products'));
    }

    public function create()
    {
        $colors = config('data.colors');
        $sizes = config('data.sizes');
        return view('admin.create', compact('colors', 'sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->save();
        $this->imageUploadFunction($product, $request->image);

        $request->session()->flash('message', 'Created');
        return redirect()->route('index');
    }

    public function edit(Product $product)
    {
        $colors = config('data.colors');
        $sizes = config('data.sizes');
        return view('admin.edit', compact('product', 'colors', 'sizes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->update();
        $request->session()->flash('message', 'Updated');
        return redirect()->route('index');
    }

    public function destroy(Product $product)
    {
        unlink("images/".$product->image);
        $product->delete();
        return redirect()->route('index');
    }

    public function imageUpload(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = Product::find($request->id);
        $this->imageUploadFunction($product, $request->image);

        return response()->json('Image uploaded successfully');
    }

    public function imageUploadFunction($product, $image)
    {
        $image_name = time().'.'.$image->extension();
        $image->move(public_path('images'), $image_name);

        $product->image = $image_name;
        $product->update();

        return true;
    }
}
