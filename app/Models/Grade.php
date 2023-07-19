<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name', 'notes'];

    // relation between grade and section => the grade hase many sections
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
