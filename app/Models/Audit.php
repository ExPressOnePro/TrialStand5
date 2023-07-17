<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{

    use HasFactory;

    public const TABLE = 'audits';

    /*protected $fillable = [
        'name'
    ];*/


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
