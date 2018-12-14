<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\User;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    /**
     * Transform the User entity.
     *
     * @param \App\Entities\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        $image = isset($model->attachment[0]) ? $model->attachment[0]->url : null;

        return [
            'id'            => (int) $model->id,

            'name'          => $model->name,
            'image'         => config('app.url').'api/users/image/'.$image,
            'email'         => $model->email,
            'cpf'           => $model->cpf,
            'birthdate'     => $model->birthdate,
            'gender'        => $model->gender,
            'skin_color'    => $model->skin_color,
            'cellphone'     => $model->cellphone,
            'phone'         => $model->phone,
            'status'        => $model->status,
            'role'          => [
                'id'            => $model->role->id,
                'name'          => $model->role->name,
                'department'    => $model->role->department
            ],

            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}
