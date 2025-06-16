<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'slug', 'deskripsi', 'tingkat_kesulitan', 'jenis_kursus', 'link_video'];

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
}