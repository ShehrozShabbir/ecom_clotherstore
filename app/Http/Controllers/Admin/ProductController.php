<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $sizes = Size::all();
        return view('admin.product.manage', ['product' => null, 'brands' => $brands, 'categories' => $categories, 'sizes' => $sizes]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.product.manage', compact('product', 'brands', 'categories'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'size' => 'required',
            'details' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'product_label' => 'nullable|in:on_sale,hot,feature,new',

        ]);
        $metaData = [];

        foreach ($request->size as $key => $value) {
            if ($key==0) {
                $validatedData['size'] = $request->size[$key];
                $validatedData['selling_price'] = $request->selling_price[$key];
                $validatedData['buying_price'] = $request->buying_price[$key];
                $validatedData['stock_quantity'] = $request->stock_quantity[$key];
            }
            $metaData[$value] = ['selling_price' => $request->selling_price[$key], 'buying_price' => $request->buying_price[$key], 'other_price' => $request->other_price[$key], 'stock_quantity' => $request->stock_quantity[$key]];
        }
        $validatedData['product_meta'] = json_encode($metaData);
        $product = Product::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);

                $product->images()->create([
                    'image_path' => 'storage/images/' . $imageName,
                ]);
            }
        }
        //validator->getMessageBag()
        flashy()->success('Product added successfully!');
        return redirect()->back()->with('status', 'Product added successfully!');



    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'details' => 'nullable|string',
                'brand_id' => 'required|exists:brands,id',
                'category_id' => 'required|exists:categories,id',
                'size' => 'nullable|string',
                'selling_price' => 'required|numeric',
                'buying_price' => 'required|numeric',
                'status' => 'required|in:available,not_available',
                'stock_quantity' => 'required|integer',
                'product_label' => 'nullable|in:on_sale,hot,feature,new',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for images
            ]);

            $product = Product::findOrFail($id);
            $product->update($validatedData);

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->storeAs('public/images', $imageName);

                    $product->images()->create([
                        'image_path' => 'storage/images/' . $imageName,
                    ]);
                }
            }

            // Handle image deletions
            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $imageId) {
                    // Find and delete the image from the database
                    $product->images()->where('id', $imageId)->delete();
                    // Optionally, delete the image file from the server
                }
            }
            $product->update($validatedData);
            flashy()->info('Product updated successfully!');
        } catch (ValidationException $e) {
            flashy()->error('Validation failed: ' . $e->getMessage());
        } catch (ModelNotFoundException $e) {
            flashy()->error('Product not found.');
        } catch (\Exception $e) {
            flashy()->error('An error occurred while updating the product.');
        }

        return redirect()->route('admin.product.list')->with('status', 'Product updated successfully!');
    }
    public function list()
    {
        $products = Product::paginate(10);

        return view('admin.product.list', ['products' => $products]);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        flashy()->success('Product deleted successfully!');
        // Redirect back with success message or to a product list page
        return redirect()->route('admin.product.list')->with('success', 'Product deleted successfully!');
    }
}
