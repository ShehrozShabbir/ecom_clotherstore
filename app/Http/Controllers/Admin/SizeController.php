<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function create(){
        return view('admin.size.add');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status'=>'required|integer',
        ]);

        $size = Size::create([
            'name' => $request->input('name'),

            'status' => $request->input('status'),
        ]);

        flashy()->success(' Size Created Successfully','#');
        // Redirect or return a response
        return redirect()->route('admin.size.create');
    }

    public function list() {
        $list =Size::all();
        return view('admin.size.list',compact('list'));
    }
    public function delete($id){
        $size = Size::find($id);
        $size->delete();
        flashy()->success('Size Deleted Successfully','#');
        // Redirect or return a response
        return redirect()->route('admin.size.list');
    }


    public function edit($id) {
        $edit = Size::find($id);
        return view('admin.size.edit', compact('edit'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|integer',
        ]);

        $review = Size::find($id);

        $review->name = $request->input('name');
        $review->status = $request->input('status');

        $review->save();

        flashy()->success(' Size Updated Successfully', '#');
        return redirect()->route('admin.size.list');
    }
}
