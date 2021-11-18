<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category_master;
use App\Models\sub_category_master;

class sub_categoryController extends Controller
{
    public function view()
    {
        $data = sub_category_master::all();
        return view('admin.subCategory.subCategory_index',['data'=>$data]); 
    }

    public function create()
    {   
        $category= category_master::all();
        return view('admin.subCategory.subCategory_action')->with(['category'=>$category]);
    }

    public function edit($id)
    {
            $data = sub_category_master::find($id);
            $category= category_master::all();
            return view('admin.subCategory.subCategory_action',['data'=>$data,'category'=>$category]); 
    }
    public function addupdate(Request $request)
    {
       
        if(isset($request->id))
        {
            $data = sub_category_master::find($request->id);
            $data->sub_category = $request->name;
            $data->category = $request->category;
            $data->save();
            return redirect('subCategory');
        }
        else
        {
            $request->validate([
                'name' => "required",
                'category' => "required",
            ]);
        $category = new sub_category_master;
        $category->sub_category = $request->name;
        $category->category = $request->category;
        $category->save();

        return redirect('subCategory');
        }
    }

    public function delete($id)
    {
        $user=sub_category_master::find($id);
        $user->delete();
        return redirect('subCategory');  
    }
}