<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /** @use HasFactory<\Database\Factories\BoardFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'owner',
    ];

    public function board()
    {
        $this->hasMany(Ticket::class);
    }
}
