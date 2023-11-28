<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabItem extends Model
{
    use HasFactory;

    protected $table = 'tb_lab_items';

    protected $guarded = 'id';
}
