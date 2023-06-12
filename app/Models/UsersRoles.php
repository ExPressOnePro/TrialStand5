<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersRoles extends Model {
    use HasFactory;

    public const TABLE = 'users_roles';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }


}
