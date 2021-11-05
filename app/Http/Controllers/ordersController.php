<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\orders;

class ordersController extends Controller
{
    public function show()
    {
        $data_orders = orders::join('customers', 'customers.id_customers', 'orders.id_customers')
        ->join('product', 'product.id_product', 'orders.id_product')
        ->select('orders.*', 'customers.nama', 'customers.telp', 'product.product_name', 'product.harga')
        ->get();
        return Response()->json($data_orders);
    }

    public function detail($id_orders)
    {
        if(orders::where('id_orders', $id_orders)->exists())
        {
            $data_orders = orders::join('customers', 'customers.id_customers', 'orders.id_customers')
        ->join('product', 'product.id_product', 'orders.id_product')
        ->select('orders.*', 'customers.nama', 'customers.telp', 'product.product_name', 'product.harga')
        ->where('id_orders', $id_orders)
        ->get();
        return Response()->json($data_orders);
        
    }else
        {
            return Response()->json(['Message' => 'Not Found']);
        }
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_customers'=>'required',
            'id_product'=>'required',
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $simpan = orders::create(
            [
                'id_customers'=>$request->id_customers,
                'id_product'=>$request->id_product,
                'tanggal'=>date('Y-m-d')
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
            'id_customers'=>'required',
            'id_product'=>'required',
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
    
        $update_orders = orders::where('id_orders', $id)->update(
            [
                'id_customers'=>$request->id_customers,
                'id_product'=>$request->id_product,
            ]);
    
            if($update_orders){
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status'=> 0]);
            }
    
    }

    public function destroy($id){
        
        $delete_orders = orders::where('id_orders', $id)->delete();
        
        if($delete_orders){
            return Response()->json(['status'=>1]);
        }else{
            return Response()->json(['status'=>0]);
        }
    }
}
