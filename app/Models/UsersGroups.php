<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGroups extends Model
{
    use HasFactory;

    public const TABLE = 'users_groups';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'group_id',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function group() {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
