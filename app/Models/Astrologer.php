<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Astrologer extends Model

{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function costs()
    {
        return $this->hasOne(AstrologerCost::class, 'astrologer_id');
    }

    public function customer_astrologer()
    {
        return $this->hasOne(Customer::class, 'astrologer_id');
    }

    public function ratingReviews()
    {
        return $this->hasMany(RatingReview::class, 'astrologer_id', 'id');
    }

    public function getAverageRatingAttribute()
    {
        $rating = $this->ratingReviews->avg('rating') ?? 0;
        return $rating;
    }

    public function getRatingCountAttribute()
    {
        return $this->ratingReviews->count() ?? '';
    }
}
