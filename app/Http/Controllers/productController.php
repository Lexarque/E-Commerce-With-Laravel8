<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product;

class productController extends Controller
{
    public function show()
    {
        return Product::all();
    }

    public function detail($id)
    {
        if(product::where('id_product', $id)->exists())
        {
            $detail_product = product::where('id_product', $id)->get();
            return Response()->json($detail_product);
        }else
        {
            return Response()->json(['Message' => 'not found']);
        }
    }
    
    public function store(Request $request)
    {
        
        $validator=Validator::make($request->all(),
        [
            'product_name' => 'required',
            'harga'=>'required',
            'product_desc'=>'required',
            'product_photo'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $simpan = product::create(
            [
                'product_name'=>$request->product_name,
                'harga'=>$request->harga,
                'product_desc'=>$request->product_desc,
                'product_photo'=>$request->product_photo
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
            'product_name' => 'required',
            'harga'=>'required',
            'product_desc'=>'required',
            'product_photo'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $update_product = product::where('id_product', $id)->update(
            [
                'product_name'=>$request->product_name,
                'harga'=>$request->harga,
                'product_desc'=>$request->product_desc,
                'product_photo'=>$request->product_photo
            ]);
    
            if($update_product){
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status'=> 0]);
            }
    
    }

    public function destroy($id){
        $delete_product=product::where('id_product', $id)->delete();
        if($delete_product)
        {
            return Response()->json(['status'=>1]);
        }else
        {
            return Response()->json(['status'=>0]);
        }
    }
}
