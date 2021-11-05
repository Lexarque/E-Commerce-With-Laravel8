<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\detail_orders;
use Illuminate\Support\Facades\DB;


class detail_ordersController extends Controller
{
    public function show()
    {
        $data_detail = detail_orders::join('orders', 'orders.id_orders', 'detail_orders.id_orders')
        ->join('product', 'product.id_product', 'detail_orders.id_product')
        ->select('detail_orders.*',  'product.product_name', 'product.harga', 'orders.tanggal')
        ->get();
        return Response()->json($data_detail);
    }

    public function detail($id_detail_orders)
    {
        if(detail_orders::where('id_detail_orders', $id_detail_orders)->exists())
        {
            $data_detail = detail_orders::join('orders', 'orders.id_orders', 'detail_orders.id_orders')
        ->join('product', 'product.id_product', 'detail_orders.id_product')
        ->select('detail_orders.*', 'orders.tanggal', 'product.product_name', 'product.harga')
        ->where('id_detail_orders', $id_detail_orders)
        ->get();
        return Response()->json($data_detail);
        
    }else
        {
            return Response()->json(['Message' => 'Not Found']);
        }
    }
    
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'id_orders' => 'required',
            'id_product'=>'required',
            'qty'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $id_product = $request->id_product;
        $qty = $request->qty;
        $harga=DB::table('product')->where('id_product', $id_product)->value('harga');
        $subtotal = $qty * $harga;

        $simpan = detail_orders::create(
            [
                'id_orders' => $request->id_orders,
                'id_product' => $id_product,
                'qty' => $qty,
                'subtotal' => $subtotal
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
            'id_orders' => 'required',
            'id_product'=>'required',
            'qty'=>'required'
        ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $id_product = $request->id_product;
        $qty = $request->qty;
        $harga=DB::table('product')->where('id_product', $id_product)->value('harga');
        $subtotal = $qty * $harga;

        $update_detail_orders = detail_orders::where('id_detail_orders', $id)->update(
            [
                'id_orders' => $request->id_orders,
                'id_product' => $id_product,
                'qty' => $qty,
                'subtotal' => $subtotal
            ]);
    
            if($update_detail_orders){
                return Response()->json(['status' => 1]);
            }else{
                return Response()->json(['status'=> 0]);
            }
    
    }

    public function destroy($id){
        $delete_detail_orders=DB::table('detail_orders')
        ->where('id_detail_orders', $id)
        ->delete();
        if($delete_detail_orders)
        {
            return Response()->json(['status'=>1]);
        }else
        {
            return Response()->json(['status'=>0]);
        }
    }
}
