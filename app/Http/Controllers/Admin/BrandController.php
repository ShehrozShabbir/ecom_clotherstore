<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function list()
{
    $brands = Brand::latest()->get();
    return view('admin.brand-list', compact('brands'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        try {
            Brand::create([
                'name' => $request->name,
                'status' => $request->status,
            ]);

            // Success flash message
            flashy()->success('Brand Created ...', '#');
        } catch (\Exception $e) {
            // Error flash message

            flashy()->error('An error occurred while adding the brand.','#');
        }

        return redirect()->back();
    }

    public function editBrandPage()
    {
        $brands = Brand::latest()->get();
        return view('admin.edit-brand', compact('brands'));
    }

    public function destroy($id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();

            // Success flash message
            flashy()->success('Brand deleted successfully!');
        } catch (\Exception $e) {
            // Error flash message
            flashy()->error('An error occurred while deleting the brand.');
        }

        return redirect()->back();
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.update-brand', compact('brand'));
    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|boolean',
        ]);

        try {
            $brand = Brand::findOrFail($id);
            $brand->update([
                'name' => $request->name,
                'status' => $request->status,
            ]);


            flashy()->success('Brand updated successfully!');
        } catch (\Exception $e) {
            flashy()->error('An error occurred while updating the brand.');
        }

        return redirect(('/dashboard/brands'));
    }


}
