<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function productColorSizes(): HasMany
    {
        return $this->hasMany(ProductColorSize::class, 'product_id');
    }
}
