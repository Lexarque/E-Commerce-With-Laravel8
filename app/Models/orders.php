<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    public $timestamps = false;

    protected $fillable = ['id_customers', 'id_product', 'tanggal'];

}
