<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebSlider extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function websliderimages()
    {
        return $this->MorphMany(Media::class, 'imageable');
    }
}
