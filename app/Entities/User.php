<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'birthdate',
        'gender',
        'skin_color',
        'cellphone',
        'phone',
        'status',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be date type.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** CONSTANTS */
    const COMMON_USER                   = 1;
    const URBAN_INSPECTOR               = 2;
    const URBAN_DIRECTOR                = 3;
    const AGENT                         = 4;
    const INSPECTOR                     = 5;
    const OPERATIONAL_DIRECTOR          = 6;
    const SUPERINTENDENT                = 7;
    const INVESTIGATOR                  = 8;
    const CHIEF_INVESTIGATOR            = 9;
    const SUPERINTENDENT_INVESTIGATOR   = 10;

    /** RELATIONSHIPS */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function logs()
    {
        return $this->morphMany(AuditLog::class, 'loggable');
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }
}
