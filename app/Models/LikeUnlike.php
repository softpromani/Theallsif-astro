<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikeUnlike extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function likeable()
    {
        return $this->morphTo();
    }
}
