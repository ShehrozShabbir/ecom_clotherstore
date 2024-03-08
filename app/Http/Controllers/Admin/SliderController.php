<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class SliderController extends Controller
{
    public function create()
    {
        return view('admin.slider.manage', ['slider' => null]);
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.manage', compact('slider'));
    }

    public function store(Request $request)
{
    // Validation rules for slider creation
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'nullable|in:active,inactive',
        // Add more validation rules as needed
    ]);
$validatedData['status'] = $request->input('status', 'inactive');
    // Store slider data
    $slider = Slider::create($validatedData);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $imageName);

        // Update image_path in database
        $slider->update(['image_path' => 'storage/images/' . $imageName]);
    }

    flashy()->success('Slider added successfully!');
    return redirect()->back()->with('status', 'Slider added successfully!');
}


    public function update(Request $request, $id)
{
    // Validation rules for slider update
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:active,inactive',
        // Add more validation rules as needed
    ]);

    // Find the slider by ID
    $slider = Slider::findOrFail($id);
$status = $request->input('status', 'active');
    // Update slider data
    $slider->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'status' => $validatedData['status'],
    ]);

    // Handle image update
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images', $imageName);

        // Update image_path in database
        $slider->update(['image_path' => 'storage/images/' . $imageName]);
    }

    flashy()->success('Slider updated successfully!');
    return redirect()->route('admin.sliders.list');
}

    public function list()
    {
        $sliders = Slider::paginate(10);

        return view('admin.slider.list', ['sliders' => $sliders]);
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        flashy()->success('Slider deleted successfully!');
        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }
}
