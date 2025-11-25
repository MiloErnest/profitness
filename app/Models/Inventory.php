<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

     protected $table = 'inventory';

    protected $fillable = [
        'product_type',
        'product_id', 
        'product_name',
        'initial_stock',
        'current_stock',
        'sold_quantity',
        'cost_price',
        'sale_price',
        'total_value',
        'last_restock_date',
        'notes'
    ];

    protected $casts = [
        'last_restock_date' => 'date',
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'total_value' => 'decimal:2'
    ];

    // Relación polimórfica con productos
    public function product()
    {
        return $this->morphTo('product', 'product_type', 'product_id');
    }

    // Calcular valor total automáticamente
    public function calculateTotalValue()
    {
        return $this->current_stock * $this->cost_price;
    }

    // Actualizar stock cuando se vende
    public function updateStock($soldQuantity)
    {
        $this->sold_quantity += $soldQuantity;
        $this->current_stock = $this->initial_stock - $this->sold_quantity;
        $this->total_value = $this->calculateTotalValue();
        $this->save();
    }

    // Reabastecer inventario
    public function restock($quantity, $costPrice = null)
    {
        if ($costPrice) {
            $this->cost_price = $costPrice;
        }
        
        $this->initial_stock += $quantity;
        $this->current_stock = $this->initial_stock - $this->sold_quantity;
        $this->total_value = $this->calculateTotalValue();
        $this->last_restock_date = now();
        $this->save();
    }

    // Scope para productos con stock bajo
    public function scopeLowStock($query, $threshold = 5)
    {
        return $query->where('current_stock', '<', $threshold)
                    ->where('current_stock', '>', 0);
    }

    // Scope para productos agotados
    public function scopeOutOfStock($query)
    {
        return $query->where('current_stock', '<=', 0);
    }
}