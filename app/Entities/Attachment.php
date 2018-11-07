<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Attachment.
 *
 * @package namespace App\Entities;
 */
class Attachment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'user_id',
        'attachable_id',
        'attachable_type'
    ];



    protected $dates = [
        'create_at',
        'update_at',
        'deleted_at'
    ];

    public function attachments(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
