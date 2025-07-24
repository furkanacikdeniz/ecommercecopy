<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'card_id';
    protected $fillable = [
        'card_id',
        'user_id',
        'code',
    ];
    public function details()
    {
        return $this->hasMany(CardDetails::class, "card_id", "card_id");
    }
}
