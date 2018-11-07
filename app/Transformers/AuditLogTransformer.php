<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AuditLog;

/**
 * Class AuditLogTransformer.
 *
 * @package namespace App\Transformers;
 */
class AuditLogTransformer extends TransformerAbstract
{
    /**
     * Transform the AuditLogController entity.
     *
     * @param \App\Entities\AuditLog $model
     *
     * @return array
     */
    public function transform(AuditLog $model)
    {
        return [
            'id'                => (int) $model->id,
            'action'            => $model->user->name . ' ' . $model->action,
            'user'              => [
                'id'    => $model->user->id,
                'name'  => $model->user->name
            ],
            'loggable_id'   => $model->loggable_id,
            'loggable_type' => $model->loggable_type,

            'created_at'        => $model->created_at->toDateTimeString(),
            'updated_at'        => $model->updated_at->toDateTimeString()
        ];
    }
}
