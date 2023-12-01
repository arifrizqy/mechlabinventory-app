<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPinjam extends Model
{
    use HasFactory;

    protected $table = 'log_loan_return';
    protected $guarded = 'id';
    protected $fillable = ['id', 'nim_or_nip', 'status', 'isDeleted']; // prod
    protected $keyType = 'string';
    public $incrementing = false;

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'nim_or_nip'); // prod
        // return $this->belongsTo(Visitor::class, 'nim'); // dev
    }

    public function detail()
    {
        return $this->belongsTo(detail::class, 'nim_or_nip');
    }
}
