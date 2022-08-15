<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'job_title',
        'location',
        'start_date',
        'end_date',
        
        
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    
}
