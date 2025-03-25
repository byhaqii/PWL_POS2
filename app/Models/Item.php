<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $fillable = [
        'item_id',
        'category_id',
        'item_code',
        'item_name',
        'item_buy_price',
        'item_sell_price',
    ];

    public function category(): HasOne {
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }
}
