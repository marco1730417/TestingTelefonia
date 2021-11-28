<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    protected $fillable = [
        'name', 'price', 'stock'
    ];
}