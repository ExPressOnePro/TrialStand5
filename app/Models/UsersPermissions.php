<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPermissions extends Model
{
    use HasFactory;

    public const TABLE = 'users_permissions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'permission_id',
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permission() {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }

}
