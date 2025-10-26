<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'owner',
        'status',
    ];

    public function tickets()
    {
        return $this->belongsTo(Board::class);
    }

}
