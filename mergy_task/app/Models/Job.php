<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Job extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'uid',
        'name',
        'email',
        'job',
        
    ];

    // public $incrementing = false;


    public function getImageAttribute($value)
    {
        if($value) return url($value);

        return $value;
    }

    /**
     * @return string
     */
    public function getCoverAttribute(): string
    {
        return $this->getFirstMediaUrl('cv');
    }
/**
     * @var string[]
     */
    protected $appends= [
        'cover'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class, 'job_id');
    }

  
}
