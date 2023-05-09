<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersRoles extends Model
{
    use HasFactory;

    public const TABLE = 'users_roles';


    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
