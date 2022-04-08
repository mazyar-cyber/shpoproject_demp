<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function branches()
    {
        return $this->hasMany(ProductCat::class, 'branch_id');
    }
}
