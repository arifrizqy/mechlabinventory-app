<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // protected $table = 'tb_item'; // prod
    protected $table = 'tb_lab_items'; // dev

    protected $fillable = [
        'id', 'code_item', 'description', 'isDeleted', 'isBorrowed'
    ];
}
