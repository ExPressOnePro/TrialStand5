<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandPublishersHistory extends Model
{
    use HasFactory;

    public const TABLE = 'stand_publishers_histories';

    protected $table = self::TABLE;

    protected $fillable = [
        'day',
        'time',
        'date',
        'stand_publishers_id',
        'user_1',
        'user_2',
        'user_3',
        'user_4',
    ];


}
