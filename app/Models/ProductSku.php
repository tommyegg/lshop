<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute($price) : string
    {
        return humanReadPrice($this->attributes['price']);
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('減庫存不可以小於0');
        }

        return $this->where('id', $this->id)->where('stock', '>=', $amount)->decrement('stock', $amount);
    }

    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加庫存不可以小於0');
        }
        $this->increment('stock', $amount);
    }
}
