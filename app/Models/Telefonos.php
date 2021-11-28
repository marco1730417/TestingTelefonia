<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    protected $fillable = [
        'name', 'price', 'stock'
    ];
}