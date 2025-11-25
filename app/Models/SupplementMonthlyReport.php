<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementMonthlyReport extends Model
{
    protected $table = 'supplements_monthly_reports';
    
    protected $fillable = [
        'year',
        'month',
        'supplement_id',
        'product_name',
        'category',
        'received',
        'additional_stock',
        'sold',
        'lost_stock',
        'final_stock',
        'cost_price',
        'sale_price',
        'total_sales_value',
        'total_cost_value',
        'profit',
        'stock_value',
        'losses_value',
        'is_closed',
        'notes'
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'total_sales_value' => 'decimal:2',
        'total_cost_value' => 'decimal:2',
        'profit' => 'decimal:2',
        'stock_value' => 'decimal:2',
        'losses_value' => 'decimal:2',
    ];

    // Relación con el suplemento
    public function supplement()
    {
        return $this->belongsTo(Supplement::class);
    }

    // Obtener nombre del mes en español
    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        return $months[$this->month] ?? '';
    }

    // Obtener período formateado
    public function getPeriodAttribute()
    {
        return $this->month_name . ' ' . $this->year;
    }
}
