<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\vendor_master;
use Illuminate\Http\Request;
use Hash;

class vendorController extends Controller
{
    public function view()
    {
        $data = vendor_master::all();
        return view('admin.vendor_index',['data'=>$data]);
    }

    public function edit($id)
    {
        $vendor = vendor_master::find($id);
        return view('admin.edit_vendor',['vendor'=>$vendor]);
    }

    public function addupdate(Request $request)
    {
        if($request->has('id'))
        {
            $data = vendor_master::find($request->id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->contact = $request->contact;
            $data->gst = $request->gst;
            $data->cin = $request->cin;
            $data->fssai = $request->fssai;
            $data->address_line_1 = $request->address1;
            $data->address_line_2 = $request->address2;
            $data->state = $request->state;
            $data->pincode = $request->pincode;
            $data->save();
            return redirect('vendors');



        }
        else
        {
        $vendor = new vendor_master;
        $vendor->name = $request->name;
        $vendor->email= $request->email;
        $vendor->contact = $request->contact;
        $vendor->username = $request->username;
        $vendor->password =  Hash::make($request->password);
        $vendor->gst = $request->gst;
        $vendor->cin =$request->cin;
        $vendor->fssai = $request->fssai;
        $vendor->address_line_1 = $request->address1;
        $vendor->address_line_2 =$request->address2;
        $vendor->state = $request->state;
        $vendor->pincode = $request->pincode;
        $vendor->save();

        return redirect('vendors');
        }
    }

    public function delete($id)
    {
        $user=vendor_master::find($id);
        $user->delete();
        return redirect('vendors');  
    }
}