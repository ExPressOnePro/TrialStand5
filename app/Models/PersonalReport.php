<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'info'
    ];

    public function user() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
