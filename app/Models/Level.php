<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $primaryKey = 'level_id';
    protected $fillable = [
        'level_id',
        'level_code',
        'level_name'
    ];
}
