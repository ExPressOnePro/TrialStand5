<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSchedules extends Model
{
    use HasFactory;


    protected $fillable = [
        'date',
        'ms_template_id',
        'schedule',
    ];

    public function meetingScheduleTemplate()
    {
        return $this->belongsTo(MeetingScheduleTemplate::class, 'ms_template_id');
    }
}
