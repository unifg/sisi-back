<?php

namespace App\Entities;


/**
 * Class OccurrenceReport.
 *
 * @package namespace App\Entities;
 */
class OccurrenceReport extends AppModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'story',
        'occurrence_date',
        'occurrence_time',
        'coordinates',
        'police_report',
        'police_report_code',
        'estimated_loss',
        'status',
        'confidential',
        'user_id',
        'agent_id',
        'occurrence_type_id',
        'zone_id'
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

    /** CONSTANTS */

    CONST OCCURRENCE_REPORT_WAITING         = 'AGUARDANDO';
    CONST OCCURRENCE_REPORT_IN_ANALYSIS     = 'ANALISE';
    CONST OCCURRENCE_REPORT_INVESTIGATION   = 'INVESTIGACAO';
    CONST OCCURRENCE_REPORT_FINISHED        = 'FINALIZADA';
    CONST OCCURRENCE_REPORT_ARCHIVED        = 'ARQUIVADA';

    /** RELATIONSHIPS */

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
    public function type()
    {
        return $this->belongsTo(OccurrenceType::class, 'occurrence_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function objects()
    {
        return $this->belongsToMany(OccurrenceObject::class,
            'occurrence_object_occurrence_report', 'report_id', 'object_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function involvedPeople()
    {
        return $this->hasMany(InvolvedPerson::class);
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
