<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    protected $fillable = ['product_name', 'harga', 'product_desc', 'product_photo'];

}
