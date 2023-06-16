<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StandReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'publications',
        'videos',
        'return_visits',
        'bible_studies',
        'StandPublishers_id',
    ];

    public function standPublishers(): HasOne
    {
        return $this->hasOne(StandPublishers::class, 'id', 'stand_id');
    }
}
