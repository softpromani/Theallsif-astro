<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ServiceAgreement extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $guarded = [];

    // public function getAstrologer()
    // {
    //     return $this->belongsTo(Astrologer::class, 'astrologer_id', 'id');
    // }

    public function astrologer()
    {
        return $this->belongsTo(Astrologer::class, 'astrologer_id');
    }
}
