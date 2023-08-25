<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSchedules extends Model
{
    use HasFactory;


    protected $fillable = [
        'congregation_id',
        'start_of_week',
        'end_of_week',
        'type_day',
        'schedule',
    ];

}
