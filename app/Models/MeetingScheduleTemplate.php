<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingScheduleTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_name',
        'congregation_id',
        'template',
    ];


    public function meetingSchedules()
    {
        return $this->hasMany(MeetingSchedules::class, 'ms_template_id');
    }
}
