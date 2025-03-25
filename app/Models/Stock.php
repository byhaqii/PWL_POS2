<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';
    protected $fillable = [
        'stock_id',
        'item_id',
        'user_id',
        'stock_qty',
    ];

    public function item(): HasOne {
        return $this->hasOne(Item::class, 'item_id', 'item_id');
    }

    public function user(): HasOne {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
