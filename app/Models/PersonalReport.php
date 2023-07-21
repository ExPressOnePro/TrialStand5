<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'month',
        'hours',
        'publications',
        'videos',
        'return_visits',
        'bible_studies',
    ];

    public function User() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}