<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model {

    public const TABLE = 'roles';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }

    public function UsersRoles() {
        return $this->belongsTo(UsersRoles::class, 'id', 'role_id');
    }

}
