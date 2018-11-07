<?php

namespace App\Entities;


/**
 * Class Zone.
 *
 * @package namespace App\Entities;
 */
class Zone extends AppModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'campus'
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'loggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function occurrences()
    {
        return $this->hasMany(OccurrenceReport::class);
    }
}
