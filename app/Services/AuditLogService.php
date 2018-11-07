<?php

namespace App\Services;

use App\Entities\AuditLog;
use App\Repositories\AuditLogRepository;
use App\Services\Traits\CrudMethods;
use App\Repositories\UserRepository;

/**
 * Class AuditLogService
 *
 * @package App\Services
 */
class AuditLogService extends AppService
{
    use CrudMethods {
        all     as public processAll;
    }

    /**
     * @var AuditLogRepository $repository
     */
    protected $repository;

    /**
     * AuditLogService constructor.
     * @param AuditLogRepository $repository
     */
    public function __construct(AuditLogRepository $repository)
    {
        $this->repository       = $repository;
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

    /**
     * @param $action
     * @param $type
     * @param $id
     * @return mixed
     */
    public static function write($action, $type, $id)
    {
        $user = UserService::getUser (true);

        return AuditLog::create([
            'action'        => $action,
            'user_id'       => $user ? $user->id : null,
            'loggable_id'   => $id,
            'loggable_type' => $type,
        ]);
    }
}
