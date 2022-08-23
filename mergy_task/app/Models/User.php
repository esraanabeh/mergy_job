<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, InteractsWithMedia, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       
        'name',
        'email',
        'uid',
        'job',
        'password'
        
    ];

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   

    public function experience()
    {
        return $this->hasMany(Experience::class, 'user_id');
    }

   
}
