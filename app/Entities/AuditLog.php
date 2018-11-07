<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AuditLogController.
 *
 * @package namespace App\Entities;
 */
class AuditLog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action',
        'user_id',
        'loggable_id',
        'loggable_type',
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

    const LOGGABLE_TYPE_ZONE            = 'zone';
    const LOGGABLE_TYPE_OCCURRENCE      = 'occurrence_report';
    const LOGGABLE_TYPE_IRREGULARITY    = 'irregularity_report';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function loggable()
    {
        return $this->morphTo();
    }

}
