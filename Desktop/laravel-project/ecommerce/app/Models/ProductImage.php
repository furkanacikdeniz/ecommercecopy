<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory;
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_id',
        'product_id',
        'image_url',
        'alt',
        'seq',
        'is_active'
    ];
    public function category()
    {
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }
}
