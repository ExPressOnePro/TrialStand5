<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInfos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'number_1',
        'number_2',
        'last_login',
        'congregation_group_id',
    ];
}
