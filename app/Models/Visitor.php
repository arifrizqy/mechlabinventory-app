<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'tb_visitor'; // prod
    // protected $table = 'tb_visitors'; // dev

    protected $fillable = [
        'id', 'name', 'telp'
    ];
}
