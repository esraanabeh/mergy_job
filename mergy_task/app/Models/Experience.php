<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_title',
        'location',
        'start_date',
        'end_data',
        
        
    ];

    public function job(){
        return $this->belongsTo(Job::class, 'user_id');
    }

    
}
