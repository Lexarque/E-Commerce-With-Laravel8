<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    public $timestamps = false;

    // protected $primaryKey = 'id_pelanggan';
    // To specify a primary key through a model

    protected $fillable = ['nama', 'alamat', 'telp', 'username', 'password'];

    //protected $hidden = ['password'];
    // Fillable but hidden during the process
}
