<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\customers;

class customersController extends Controller
{
    public function show()
    {
        return customers::all();
    }

    public function detail($id)
    {
        if(customers::where('id_customers', $id)->exists())
        {
            $data_customers=customers::where('id_customers', $id)
            ->get();
            return($data_customers);
        
        }else
        {
            return Response()->json(['Message'=>'not found']);
        }
    }
    
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'nama' => 'required',
            'alamat'=>'required',
            'telp'=>'required',
            'username'=>'required',
            'password'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $simpan = customers::create(
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'username'=>$request->username,
                'password'=>Hash::make($request->password)
            ]);
    
            if($simpan){
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status'=> 0]);
            }
    
    }

    public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'nama' => 'required',
            'alamat'=>'required',
            'telp'=>'required',
            'username'=>'required',
            'password'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $update_customers = customers::where('id_customers', $id)->update(
            [
                'nama'=>$request->nama,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'username'=>$request->username,
                'password'=>Hash::make($request->password)
            ]);
    
            if($update_customers){
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status'=> 0]);
            }
    
    }

    public function destroy($id){
        
        $delete_customers=customers::where('id_customers', $id)->delete();
        if($delete_customers){
            return Response()->json(['status'=>1]);
        }else
        {
            return Response()->json(['status'=>0]);
        }
    }
    

    
}


