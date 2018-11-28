<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class IrregularityReport.
 *
 * @package namespace App\Entities;
 */
class IrregularityReport extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'story',
        'coordinates',
        'irregularity_date',
        'irregularity_time',
        'user_id',
        'agent_id',
        'irregularity_type_id',
        'zone_id',
        'logs_id',
        'attachments_id',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /** CONSTANTS */

    CONST OCCURRENCE_REPORT_WAITING         = 'AGUARDANDO';
    CONST OCCURRENCE_REPORT_IN_ANALYSIS     = 'ANALISE';
    CONST OCCURRENCE_REPORT_INVESTIGATION   = 'INVESTIGACAO';
    CONST OCCURRENCE_REPORT_FINISHED        = 'FINALIZADA';
    CONST OCCURRENCE_REPORT_ARCHIVED        = 'ARQUIVADA';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function irregularity()
    {
        return $this->hasMany(IrregularityReport::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(IrregularityType::class, 'irregularity_type_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function logs()
    {
        return $this->morphMany(AuditLog::class, 'loggable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

}
