<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;
    public $translatable = ['section_name'];
    protected $guarded = [];

    protected $table = 'sections';
    public $timestamps = true;



    // relationship between sections and classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // relation between Section and Teacher => the Section HasMany Teacher
    public function Teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
}
