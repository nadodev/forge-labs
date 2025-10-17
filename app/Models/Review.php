<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_id',
        'author_name',
        'author_email',
        'rating',
        'comment',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::saved(function ($review) {
            // Recalcular rating do sistema
            $system = $review->system;
            $approvedReviews = $system->approvedReviews();
            
            $avgRating = $approvedReviews->avg('rating');
            $reviewsCount = $approvedReviews->count();
            
            $system->update([
                'rating' => round($avgRating, 2),
                'reviews_count' => $reviewsCount
            ]);
        });
    }
}
