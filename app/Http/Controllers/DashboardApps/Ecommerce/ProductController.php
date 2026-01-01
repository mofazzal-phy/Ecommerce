<?php

namespace App\Http\Controllers\DashboardApps\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests
;

class ProductController extends Controller
{
    use AuthorizesRequests;
    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $products = Product::paginate(10); // ✅ relation বাদ
        return view(
            'backend.layout.dashboard-apps.ecommerce.products.index',
            compact('products')
        );
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('backend.layout.dashboard-apps.ecommerce.products.addProduct');
    }

    // ===============================
    // STORE
    // ===============================
public function store(Request $request)
{
    $this->authorize('product.create');
    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'status' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'gallery_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ]);

    $product = new Product();
    $product->title = $request->title;
    $product->category = $request->category ?? 'Uncategorized';
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->status = strtolower($request->status);

    // Main Image Upload
    if ($request->hasFile('image')) {
        $imageName = time().'_'.$request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/products'), $imageName);
        $product->image = $imageName;
    }

    // Gallery Images Upload
    if ($request->hasFile('gallery_image')) {
        $galleryImages = [];
        foreach ($request->file('gallery_image') as $file) {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/products/gallery'), $name);
            $galleryImages[] = $name;
        }
        $product->gallery_image = json_encode($galleryImages);
    }

    $product->save();

    return redirect()->route('dashboard-apps-ecommerce-products')->with('success', 'Product created successfully!');
}


    // ===============================
    // EDIT
    // ===============================
public function edit($id)
{
    $product = Product::findOrFail($id);

    return view('backend.layout.dashboard-apps.ecommerce.products.edit', compact('product'));
}


    // ===============================
    // UPDATE
    // ===============================
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->title = $request->title;
    $product->category = $request->category;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->status = strtolower($request->status);

    // Main image
    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);
        $product->image = $imageName;
    }

    // Gallery images
    if ($request->hasFile('gallery_image')) {
        $gallery = [];

        foreach ($request->gallery_image as $img) {
            $name = time().'_'.$img->getClientOriginalName();
            $img->move(public_path('uploads/products/gallery'), $name);
            $gallery[] = $name;
        }

        $product->gallery_image = json_encode($gallery);
    }

    $product->save();

    return redirect()
        ->route('dashboard-apps-ecommerce-products')
        ->with('success', 'Product updated successfully');
}


    // ===============================
    // DELETE
    // ===============================
public function destroy(Product $product)
{
    // Delete main image
    if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
        unlink(public_path('uploads/products/' . $product->image));
    }

    // Delete gallery images
    if ($product->gallery_image) {
        $galleryImages = json_decode($product->gallery_image, true) ?: [];
        foreach ($galleryImages as $img) {
            if (file_exists(public_path('uploads/products/gallery/' . $img))) {
                unlink(public_path('uploads/products/gallery/' . $img));
            }
        }
    }

    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully!');
}

}
