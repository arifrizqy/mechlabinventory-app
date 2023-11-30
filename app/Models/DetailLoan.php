<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLoan extends Model
{
    use HasFactory;

    protected $table = 'detail_loan';
    protected $fillable = [
        'loan_id', 'item_id', 'qty'
    ];

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function loan(){
        return $this->belongsTo(PostPinjam::class, 'nim_or_nip');
    }
}
