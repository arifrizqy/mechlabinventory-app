<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPinjam extends Model
{
    use HasFactory;


    protected $table = 'log_loan_return';
    protected $guarded = 'id';
    protected $fillable = ['nim', 'item_id', 'status', 'isDeleted'];


    public function visitor(){
        return $this->belongsTo(Visitor::class, 'nim');

    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }


}
