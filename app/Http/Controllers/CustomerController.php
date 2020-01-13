<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class CustomerController extends Controller
{
    public function index() {
        $results = Customer::get();
        return response()->json(['customers'=>$results], 200);
    }

    public function create(Request $request) 
    {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'contact_number' => 'required',
        ]);
 
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $customer = new Customer;
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->contact_number = $request->input('contact_number');
            $customer->save();
     
            return response()->json([
                'error' => false,
                'customer'  => $customer,
            ], 200);
        }
    }

    public function show($id) 
    {
        $customer = Customer::find($id);
 
        if(is_null($customer)){
            return response()->json([
                'error' => true,
                'message'  => "Record with id # $id not found",
            ], 404);
        }
 
        return response()->json([
            'error' => false,
            'customer'  => $customer,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
        ]);
 
        if($validation->fails()){
            return response()->json([
                'error' => true,
                'messages'  => $validation->errors(),
            ], 200);
        }
        else
        {
            $customer = Customer::find($id);
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->contact_number = $request->input('contact_number');
            $customer->save();
     
            return response()->json([
                'error' => false,
                'customer'  => $customer,
            ], 200);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
 
        if(is_null($customer)){
            return response()->json([
                'error' => true,
                'message'  => "Record with id # $id not found",
            ], 404);
        }
 
        $customer->delete();
     
        return response()->json([
            'error' => false,
            'message'  => "Customer record successfully deleted id # $id",
        ], 200);
    }

}
