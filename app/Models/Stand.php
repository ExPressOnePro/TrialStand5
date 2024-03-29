<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stand extends Model
{
    public const TABLE = 'stands';

    use HasFactory;

    protected $fillable = [
        'name',
        'congregation_id',
    ];

    /**
     * Get the congregations that owns the Stand
     *
     * @return BelongsTo
     */
    public function congregations(): BelongsTo
    {
        return $this->belongsTo(Congregation::class);
    }

    public function standTemplate(): BelongsTo
    {
        return $this->belongsTo(StandTemplate::class, 'id','stand_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'congregation_id', 'congregation_id');
    }

}
