<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'slug',
        'soal',
        'jawaban_benar',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function correctAnswer()
    {
        return $this->belongsTo(QuizOption::class, 'jawaban_benar');
    }

    public function options()
    {
        return $this->hasMany(QuizOption::class);
    }
}