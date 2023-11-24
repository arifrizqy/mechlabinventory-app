<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabItems extends Model
{
    use HasFactory;

    protected $table = 'tb_lab_items';

    protected $fillabel = [
        "item_id", "description"
    ];
}
