<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstrologerCost extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'astrologer_cost' => 'integer',
    ];

    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_id');
    }
}
