<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create()  {
        return view('admin.category.manage',['data'=>false]);
    }
    public function edit($id)  {
        $data=Category::find(base64_decode($id));
        if($data){
            return view('admin.category.manage',['data'=>$data]);
        }
        flashy()->error('An error occurred while Getting the Category.','#' );
        return redirect()->back();

    }
    public function list()  {
        $data=Category::all();
        return view('admin.category.list',['data'=>$data]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',

        ]);

        try {
            if($request->id==''){
                Category::create([
                    'name' => $request->name,
                    'main_category' => $request->main_category,
                    'status' => $request->status,
                ]);

                // Success flash message

                flashy()->success('Category added successfully!','#');
            }else{

                Category::where('id',$request->id)->update([
                    'name' => $request->name,
                    'main_category' => $request->main_category,
                    'status' => $request->status,
                ]);
                flashy()->info('Category Updated successfully!','#');
            }

        } catch (\Exception $e) {
            // Error flash message
            flashy()->error($e->getMessage());
        }

        return redirect()->back();
    }
}
