<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPinjam extends Model
{
    use HasFactory;


    protected $table = 'log_loan_return';
    protected $guarded = 'id';
    // protected $fillable = ['nim_or_nip', 'item_id', 'status', 'isDeleted']; // prod
    protected $fillable = ['nim', 'item_id', 'status', 'isDeleted']; // dev

    public function visitor()
    {
        // return $this->belongsTo(Visitor::class, 'nim_or_nip'); // prod
        return $this->belongsTo(Visitor::class, 'nim'); // dev
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
