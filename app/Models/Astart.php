<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Astart extends Model {
    use HasFactory;

    public const TABLE = 'astarts';

    protected $fillable = [
        'user_id',
        'password'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

}
