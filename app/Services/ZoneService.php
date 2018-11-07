<?php

namespace App\Services;

use App\Entities\AuditLog;
use App\Repositories\ZoneRepository;
use App\Services\Traits\CrudMethods;

/**
 * Class ZoneService
 *
 * @package App\Services
 */
class ZoneService extends AppService
{
    use CrudMethods {
        all    as protected processAll;
        create as protected processCreate;
        update as protected processUpdate;
        delete as protected processDelete;
    }

    /**
     * @var ZoneRepository $repository
     */
    protected $repository;

    /**
     * RoleService constructor.
     *
     * @param ZoneRepository $repository
     */
    public function __construct(ZoneRepository $repository)
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

    public function create($data)
    {
        $zone = $this->processCreate($data);
        AuditLogService::write('criou zona', AuditLog::LOGGABLE_TYPE_ZONE,  $zone['data']['id']);

        return $zone;
    }

    public function update(array $data, $id)
    {
        $zone = $this->processUpdate($data, $id);
        AuditLogService::write('editou zona', AuditLog::LOGGABLE_TYPE_ZONE,  $id);

        return $zone;
    }

    public function delete($id)
    {
        $zone = $this->processDelete($id);
        AuditLogService::write('deletou zona', AuditLog::LOGGABLE_TYPE_ZONE,  $id);

        return $zone;
    }
}
