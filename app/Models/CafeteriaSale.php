<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CafeteriaSale extends Model
{
    protected $fillable = [
        'product_name',
        'category',
        'price',
        'cost_price',
        'stock',
        'received',
        'additional_stock',
        'sold',
        'lost_stock',
        'unit_price',
        'total_value',
        'description',
        'image',
        'notes'
    ];
}