<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;


    protected $fillable = [
        'id_user',
        'number_1',
        'number_2',
    ];
}
