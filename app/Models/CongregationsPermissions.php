<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongregationsPermissions extends Model
{
    use HasFactory;

    public const TABLE = 'congregations_permissions';

    public $timestamps = false;

    protected $fillable = [
        'congregation_id',
        'permission_id',
    ];

    public function congregation() {
        return $this->belongsTo(Congregation::class, 'id', 'congregation_id');
    }

    public function permission() {
        return $this->hasOne(Permission::class, 'id', 'permission_id');
    }
}
