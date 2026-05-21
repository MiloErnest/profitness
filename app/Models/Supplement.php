<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    use HasFactory;
   protected $fillable = [
    'name',
    'category',
    'description',
    'price',
    'cost_price',
    'image',
    'received',
    'additional_stock',
    'sold',
    'lost_stock',
    'stock',
    'unit_price',
    'total_value',
    'date',
    'notes'
];
}
