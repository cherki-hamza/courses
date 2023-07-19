<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    // relation between Teacher and Section => the Teacher HasMany Section
    public function Sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }
}
