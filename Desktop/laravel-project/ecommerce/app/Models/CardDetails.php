<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    use HasFactory;
    protected $primaryKey = 'card_detail_id';
    protected $fillable = [
        "card_detail_id",
        "card_id",
        "product_id",
        "quantity",
    ];
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'product_id');
}
public function card()
{
    return $this->belongsTo(Card::class, 'card_id', 'card_id');
}

}
