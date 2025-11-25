<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportClothes extends Model
{
    use HasFactory;

    protected $table = 'sports_clothes';

    protected $fillable = [
        'product_name',
        'gender',
        'category',
        'image',
        'description',
        'price',
        'cost_price',
        'received',
        'additional_stock',
        'sold',
        'lost_stock',
        'stock',
        'unit_price',
        'total_value',
        'date',
        'notes',
    ];

    public $timestamps = true;
}
