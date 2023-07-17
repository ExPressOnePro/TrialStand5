<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RolesPermissions extends Model
{
    use HasFactory;

    public const TABLE = 'users_roles';

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
