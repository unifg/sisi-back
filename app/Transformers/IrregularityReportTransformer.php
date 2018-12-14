<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\IrregularityReport;

/**
 * Class IrregularityReportTransformer.
 *
 * @package namespace App\Transformers;
 */
class IrregularityReportTransformer extends TransformerAbstract
{
    /**
     * Transform the IrregularityReport entity.
     *
     * @param \App\Entities\IrregularityReport $model
     *
     * @return array
     */
    public function transform(IrregularityReport $model)
    {
        return [

            'id'                    => (int) $model->id,

            'title'                 => $model->title,
            'story'                 => $model->story,
            'coordinates'           => $model->coordinates,
            'status'                => $model->status,
            'user'                  => [
                'id'            => $model->user->id,
                'name'          => $model->user->name,
                'cpf'           => $model->user->cpf,
                'cellphone'     => $model->user->cellphone,
                'email'         => $model->user->email
            ],
            'agent'                 => [
                'id'    => $model->agent->id ?? null,
                'name'  => $model->agent->name ?? null,
            ],
            'irregularity_type'  => [
                'id'            => $model->type->id,
                'name'          => $model->type->name,
                'description'   => $model->type->description,
            ],
            'zone'                  => [
                'id'            => $model->zone->id,
                'name'          => $model->zone->name,
                'description'   => $model->zone->description,
            ],

            'created_at'            => $model->created_at->toDateTimeString(),
            'updated_at'            => $model->updated_at->toDateTimeString()
        ];
    }
}
