<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable {

    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions, \OwenIt\Auditing\Auditable;


    public const TABLE = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'login',
        'email',
        'password',
        'congregation_id',
        'groups_id',
        'mobile_phone',
        'additional_phone',
        'brief_information',
        'gender',
        'hometown',
        'languages',
        'city',
        'address',
        'birthday',
        'christening_day',
        'last_login',
        'user_agent',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function congregation(): BelongsTo {
        return $this->belongsTo(Congregation::class);
    }

    public function usersroles() {
        return $this->hasMany(UsersRoles::class, 'user_id', 'id');
    }

    public function CongregationRequests() {
        return $this->hasMany(CongregationRequests::class, 'user_id', 'id');
    }

    public function StandReports() {
        return $this->hasMany(StandReports::class, 'user_id', 'id');
    }

    public function UsersPermissions() {
        return $this->hasMany(UsersPermissions::class, 'user_id', 'id');
    }

    public function UsersGroups() {
        return $this->hasMany(UsersGroups::class, 'user_id', 'id');
    }

    public function PersonalReport() {
        return $this->hasMany(PersonalReport::class, 'user_id', 'id');
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
