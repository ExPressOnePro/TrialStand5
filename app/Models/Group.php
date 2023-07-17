<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Group extends Model
{
    use HasFactory;

    public const TABLE = 'users_groups';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'congregation_id',
        'responsible_user_id',
        'assistant_user_id',
        'meeting_place',
        'meeting_day',
        'meeting_time',
    ];

    public function congregation() {
        return $this->belongsTo(Congregation::class, 'id', 'congregation_id');
    }

    public function responsibleUserId(): HasOne {
        return $this->hasOne(User::class, 'id', 'responsible_user_id');
    }

    public function assistant_user_id() {
        return $this->hasOne(Role::class, 'id', 'assistant_user_id');
    }
}
