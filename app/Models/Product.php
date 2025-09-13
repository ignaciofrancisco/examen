<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'nombre',
        'descripcion_corta',
        'descripcion_larga',
        'imagen_url',
        'precio_neto',
        'precio_venta',
        'stock_actual',
        'stock_minimo',
        'stock_bajo',
        'stock_alto'
    ];

    // Calcula precio_venta con IVA 19% antes de guardar
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (!is_null($product->precio_neto)) {
                $product->precio_venta = round($product->precio_neto * 1.19, 2);
            }
        });
    }
}
