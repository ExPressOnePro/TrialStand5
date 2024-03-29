<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiTokens extends Model
{
    use HasFactory;

    public const TABLE = 'api_tokens';

    protected $fillable = [
        'user_id',
        'token',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
}
