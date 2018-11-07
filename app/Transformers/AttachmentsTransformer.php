<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Attachment;

/**
 * Class AttachmentsTransformer.
 *
 * @package namespace App\Transformers;
 */
class AttachmentsTransformer extends TransformerAbstract
{
    /**
     * Transform the Attachment entity.
     *
     * @param \App\Entities\Attachment $model
     *
     * @return array
     */
    public function transform(Attachment $model)
    {
        return [
            'id'                    => (int) $model->id,

            'url'                   => $model->url,
            'user'                  => [
                'id'    => $model->user->id,
                'name'  => $model->user->name
            ],

            'created_at'            => $model->created_at->toDateTimeString(),
            'updated_at'            => $model->updated_at->toDateTimeString()
        ];
    }
}
