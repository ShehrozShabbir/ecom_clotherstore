<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ProductController extends Controller
{
    public function showProduct($id){
        $id=base64_decode($id);
        $product=Product::with('images')->where('id',$id)->first();
        // return $product;
        return view('admin.product.detail',compact('product'));
    }
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
        $sizes = Size::all();
        return view('admin.product.manage', compact('product', 'brands', 'categories', 'sizes'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'size' => 'required',
            'discount' => 'required',
            'details' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'product_label' => 'nullable|in:on_sale,hot,feature,new',

        ]);
        $metaData = [];

        foreach ($request->size as $key => $value) {
            if(!empty($request->selling_price[$key]) AND !empty($request->buying_price[$key])):
            if ($key == 0) {
                $validatedData['size'] = $request->size[$key];
                $NewAmount=$request->selling_price[$key]-($request->selling_price[$key]*$request->discount)/100;
                $validatedData['selling_price'] = $request->selling_price[$key];
                $validatedData['discounted_price'] = $NewAmount;
                $validatedData['buying_price'] = $request->buying_price[$key];
                $validatedData['stock_quantity'] = ($request->stock_quantity[$key])?(int)$request->stock_quantity[$key]:0;
            }
            $metaData[$value] = ['selling_price' => $request->selling_price[$key], 'buying_price' => $request->buying_price[$key], 'other_price' => $request->other_price[$key], 'stock_quantity' =>($request->stock_quantity[$key])?(int)$request->stock_quantity[$key]:0];
            endif;
        }
        $Category=Category::find($request->category_id);

        $validatedData['main_category']=$Category->main_category;
        $validatedData['product_meta'] = json_encode($metaData);
        $product = Product::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' .str_replace(' ','',$image->getClientOriginalName());
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
        // try {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'details' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'size' => 'required',
            'discount' => 'required',
            'status' => 'required|in:available,not_available',

            'product_label' => 'nullable|in:on_sale,hot,feature,new',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update basic product details

        // Detach existing sizes
        // $product->sizes()->detach();

        // // Attach new sizes with prices and quantities
        // foreach ($validatedData['size'] as $key => $size) {
        //     $product->sizes()->attach($size, [
        //         'selling_price' => $validatedData['selling_price'][$key],
        //         'buying_price' => $validatedData['buying_price'][$key],
        //         'stock_quantity' => $validatedData['stock_quantity'][$key],
        //     ]);
        // }
        $metaData = [];

        foreach ($request->size as $key => $value) {
            if(!empty($request->selling_price[$key]) AND !empty($request->buying_price[$key])):
            if ($key == 0) {
                $validatedData['size'] = $request->size[$key];
                $discounted_price=$request->selling_price[$key]-($request->selling_price[$key]*$request->discount)/100;
                $validatedData['selling_price'] = $request->selling_price[$key];
                $validatedData['discounted_price'] = $discounted_price;
                $validatedData['buying_price'] = $request->buying_price[$key];
                $validatedData['stock_quantity'] = ($request->stock_quantity[$key])?(int)$request->stock_quantity[$key]:0;
            }
            $metaData[$value] = ['selling_price' => $request->selling_price[$key], 'buying_price' => $request->buying_price[$key], 'other_price' => $request->other_price[$key], 'stock_quantity' =>($request->stock_quantity[$key])?(int)$request->stock_quantity[$key]:0];
            endif;
        }

        $validatedData['product_meta'] = json_encode($metaData);
        $product->update([
            'name' => $validatedData['name'],
            'details' => $validatedData['details'],
            'brand_id' => $validatedData['brand_id'],
            'category_id' => $validatedData['category_id'],
            'selling_price' => $validatedData['selling_price'],
            'buying_price' => $validatedData['buying_price'],
            'product_meta' => $validatedData['product_meta'],
            'size' => $validatedData['size'],
            'discount' => $validatedData['discount'],
            'discounted_price' => $validatedData['discounted_price'],
            'status' => $validatedData['status'],
            'product_label' => $validatedData['product_label'],

        ]);
        // Handle image deletions
        if ($request->has('deleted_images')) {
            $deletedImages = $request->input('deleted_images');

            if (is_array($deletedImages)) {
                foreach ($deletedImages as $imageId) {
                    // Your deletion logic here
                    $product->images()->where('id', $imageId)->delete();
                    // Optionally, delete the image file from the server
                }
            } else {
                // If only one image is deleted, $deletedImages will be a string
                $product->images()->where('id', $deletedImages)->delete();
                // Optionally, delete the image file from the server
            }
        }

        // Handle image uploads...
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_'.str_replace(' ','',$image->getClientOriginalName());
                $image->storeAs('public/images', $imageName);

                $product->images()->create([
                    'image_path' => 'storage/images/' . $imageName,
                ]);
            }
        }

        flashy()->success('Product updated successfully!');
        // } catch (ValidationException $e) {
        //     // Handle validation errors
        //     flashy()->error('Validation failed: ' . $e->getMessage());
        // } catch (ModelNotFoundException $e) {
        //     // Handle model not found error
        //     flashy()->error('Product not found.');
        // } catch (\Exception $e) {
        //     // Log the error
        //     \Log::error('Error updating product: ' . $e->getMessage());
        //     // Flash an error message
        //     flashy()->error('An error occurred while updating the product. Please try again later.');
        // }

        return redirect()->route('admin.product.list')->with('status', 'Product updated successfully!');
    }

    public function list()
    {
        $products = Product::latest()->paginate(10);
        $discountTitles=Discount::where('status',1)->get();

        return view('admin.product.list', compact('discountTitles','products'));
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        flashy()->success('Product deleted successfully!');
        // Redirect back with success message or to a product list page
        return redirect()->route('admin.product.list')->with('success', 'Product deleted successfully!');
    }

    public function manageDiscounts()
{
    $discountableProducts = Product::where('product_label', 'on_sale')
                                   ->where('discount', 0)
                                   ->get();
    return view('admin.product.discount.manage', compact('discountableProducts'));
}



    public function editDiscount(Product $product)
    {
        // Retrieve the product information
        $product = Product::findOrFail($product->id);

        // Retrieve the discount related to the product, if it exists
        $discount = Discount::where('product_id', $product->id)->first();

        // Retrieve all available discount titles
        $discountTitles = Discount::select('title')->distinct()->get();

        // Return the view for editing the discount
        return view('admin.product.discount.edit', compact('product', 'discount', 'discountTitles'));
    }

    public function updateDiscount(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'percentage' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Insert or update data in the discounts table
        $discount = Discount::updateOrCreate(
            ['product_id' => $product->id],
            $validatedData
        );

        // Update the discount column in the products table
        $product->discount = $validatedData['percentage'];
        $product->save(); // Save the product to update the discount value

        flashy()->success('Discount updated successfully!');

        // Optionally, redirect back or to a different page
        return redirect()->back()->with('success', 'Discount updated successfully!');
    }
    public function discountOnProducts(REQUEST $request)
    {
        $validator = Validator::make($request->all(), [
            'product_ids' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'title' => 'required',
            'discount' => 'required|integer|min:0|max:100',

        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = ['message' => reset($messages)[0],
                'status' => 'error', 'code' => 500];
            flashy()->error(reset($messages)[0]);
            return redirect()->back();

        } else {
            $productIds = explode(',', $request->product_ids);
            foreach ($productIds as $key => $value) {

                // update product...
                $product = Product::find($value)->update(['product_label' => 'on_sale', 'discount' => $request->discount]);

                // Retrieve the discount related to the product, if it exists
                $discount = Discount::updateOrCreate(
                    ['product_id' => $value], [
                        'percentage' => $request->discount,
                        'title' => $request->title,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                    ]

                );

            }
            flashy()->success("Products has been put on sale with discount " . $request->discount);
            return redirect()->back();
        }
    }
public function createDiscount()
{
     $discountableProducts = Product::where('product_label', 'on_sale')->get();
    // You may need to pass any necessary data to the view here
    return view('admin.product.discount.creatediscount', compact('discountableProducts'));
}
public function storeDiscount(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required',
        'percentage' => 'required|integer|min:0|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'status' => 'required|boolean',
        'product_id' => 'required|exists:products,id',
    ]);

   // Assign the received product_id to the Discount model
    $validatedData['product_id'] = $request->product_id;
    // Create the discount
    $discount = Discount::create($validatedData);
flashy()->success('Discount created successfully!');
    // Optionally, you can return a response or redirect back
    return redirect()->back()->with('success', 'Discount created successfully!');
}

public function discountedProductList()
    {
        // Retrieve all discounts along with associated product information
       $discounts = Discount::all();
        return view('admin.product.discount.discounted_product_list', compact('discounts'));
    }
public function editDiscountedProduct(Discount $discount)
{
    // Retrieve the discounted product information based on the discount
    $product = $discount->product;

    // Retrieve the discount titles for the dropdown
    $discountTitles = Discount::select('title')->distinct()->get();

    // Return the view for editing the discounted product
    return view('admin.product.discount.discounted_product_edit', compact('product', 'discount', 'discountTitles'));
}
public function updateDiscountedProduct(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'percentage' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
        ]);

        // Find the discount by ID
        $discount = Discount::findOrFail($id);

        // Update the discount details
        $discount->update($validatedData);

        // Find the associated product
$product = $discount->product;

// Check if the product exists before accessing its properties
if ($product) {
    // Update the discount value in the product table
    $product->discount = $validatedData['percentage'];
    $product->save();

    flashy()->success('Discounted product updated successfully!');
} else {
    // Handle the case where the associated product is not found
    flashy()->error('Associated product not found!');
}

// Redirect back or to a different page
return redirect()->back()->with('success', 'Discounted product updated successfully!');


        flashy()->success('Discounted product updated successfully!');

        return redirect()->back()->with('success', 'Discounted product updated successfully!');
    }

}
