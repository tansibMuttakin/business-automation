<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
        "description"
    ];

    /**
     * Defines the relationship between the Category model and the Product model.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Product, Category>
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
