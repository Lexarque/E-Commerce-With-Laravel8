<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_orders extends Model
{
    protected $table = 'detail_orders';
    public $timestamps = false;

    protected $fillable = ['id_orders', 'id_product', 'qty', 'subtotal'];

}
