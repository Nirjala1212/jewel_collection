<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'material',
        'weight',
        'price',
        'discount',
        'stock_quantity',
        'low_stock_threshold',
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function getFinalPriceAttribute()
{
    return $this->price - ($this->discount ?? 0);
}
}
