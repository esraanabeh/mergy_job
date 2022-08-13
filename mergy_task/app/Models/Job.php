<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job',
        
        
    ];

    public function getImageAttribute($value)
    {
        if($value) return url($value);

        return $value;
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }
}
