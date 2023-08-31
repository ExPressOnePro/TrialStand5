<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StandReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'standPublisherInfo',
        'reportInfo',

    ];

    public function standPublishers(): HasOne {
        return $this->hasOne(StandPublishers::class, 'id', 'stand_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
