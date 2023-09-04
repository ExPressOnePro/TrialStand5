<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
    ];

    public $timestamps = false;

    protected $table = 'password_resets'; // Укажите имя таблицы, если оно отличается

    protected $primaryKey = 'email'; // Укажите первичный ключ, если он отличается

    public $incrementing = false; // Укажите, если первичный ключ не является автоинкрементируемым

    protected $keyType = 'string'; // Укажите тип первичного ключа, если это не целое число
}
