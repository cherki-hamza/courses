<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['Name_Class'];

    public function Grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
