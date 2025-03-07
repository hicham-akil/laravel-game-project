<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'selected_option',
        'is_correct',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Quiz model
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Define the relationship with the Question model
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
