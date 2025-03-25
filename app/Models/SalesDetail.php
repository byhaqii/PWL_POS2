<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    protected $table = 'sales_details';
    protected $primaryKey = 'detail_id';
    protected $fillable = [
        'detail_id',
        'sales_id',
        'item_id',
        'detail_qty',
        'detail_price'
    ];
}
