<?php

namespace App\Services;

use App\Entities\Attachment;
use App\Repositories\AttachmentsRepository;
use App\Services\Traits\CrudMethods;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class UserService
 *
 * @package App\Services
 */
class AttachmentsService extends AppService
{
    use CrudMethods {
        all    as protected processAll;
        create as protected processCreate;
    }

    /**
     * @var AttachmentsRepository $repository
     */
    protected $repository;

    /**
     * RoleService constructor.
     *
     * @param AttachmentsRepository $repository
     */
    public function __construct(AttachmentsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $limit
     * @return array|mixed
     */
    public function all($limit = 20)
    {
        $this->repository
            ->resetCriteria()
            ->pushCriteria(app('App\Criterias\AppRequestCriteria'));

        return $this->processAll($limit);
    }

    public function showProfileImage($image)
    {
        $path = storage_path().'/app/users/'.$image;

        \Log::debug($path);

        return Image::make($path)->response();
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function upload($data)
    {
        $user = isset($data['user_id']) ? $data['user_id'] : UserService::getUser(true)->id;

        Attachment::create([
            'url'           => $data['url'],
            'user_id'       => $user ?? null,
            'attachable_id'   => $data['attachable_id'],
            'attachable_type' => $data['attachable_type']
        ]);
    }
}
