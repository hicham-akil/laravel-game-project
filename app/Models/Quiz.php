<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'title',
        'is_active',
        'start_time',
        'duration',
        'winner_id',
    ];

    // Define relationships (if any)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }
}
