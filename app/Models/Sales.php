<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sales_id';
    protected $fillable = [
        'sales_id',
        'user_id',
        'sales_code',
        'sales_buyer',
    ];
}
