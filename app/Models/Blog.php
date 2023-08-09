<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function images()
    {
        return $this->MorphMany(Media::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
