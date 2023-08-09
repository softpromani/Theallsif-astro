<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getImgAttribute()
    {
        return asset('storage/' . $this->path . $this->image_name);
    }

    // public function blog(){
    //     return $this->hasOne(Blog::class, '');
    // }
}
