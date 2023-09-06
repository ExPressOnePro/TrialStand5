<?php

namespace App\Traits;
use App\Models\Role;
use App\Models\Permission;

trait HasRolesAndPermissions
{

    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'users_permissions');
    }

    public function hasRole(... $roles ) {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission->slug);
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug',$permissions)->get();
    }

    public function givePermissionsTo(... $permissions)
    {
        // Получите все текущие разрешения пользователя
        $currentPermissions = $this->permissions->pluck('slug')->toArray();

        // Фильтруйте переданные разрешения, чтобы исключить дубликаты
        $permissions = array_diff($permissions, $currentPermissions);

        // Получите объекты разрешений для добавления
        $permissionsToAdd = $this->getAllPermissions($permissions);

        // Если нет разрешений для добавления, завершите выполнение
        if (empty($permissionsToAdd)) {
            return $this;
        }

        // Сохраните только новые разрешения
        $this->permissions()->saveMany($permissionsToAdd);

        return $this;
    }

    public function deletePermissions(... $permissions)
    {
        // Получите объекты разрешений для удаления
        $permissionsToDelete = $this->getAllPermissions($permissions);

        // Удалите разрешения
        $this->permissions()->detach($permissionsToDelete);


        return $this;
    }

    public function refreshPermissions(... $permissions )
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }
}
