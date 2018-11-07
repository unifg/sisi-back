<?php

namespace App\Services;

use App\Entities\AuditLog;
use App\Entities\OccurrenceReport;
use App\Repositories\OccurrenceReportRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 *
 * @package App\Services
 */
class OccurrenceReportService extends AppService
{
    use CrudMethods {
        all    as protected processAll;
        create as protected processCreate;
        update as protected processUpdate;
    }

    /** @var OccurrenceReportRepository  */
    protected $repository;

    /** @var InvolvedPeopleService  */
    protected $involvedPeopleService;

    /** @var OccurrenceObjectService  */
    protected $occurrenceObjectService;

    /**
     * OccurrenceReportService constructor.
     *
     * @param OccurrenceReportRepository $repository
     * @param InvolvedPeopleService $involvedPeopleService
     * @param OccurrenceObjectService $occurrenceObjectService
     */
    public function __construct(OccurrenceReportRepository $repository,
                                InvolvedPeopleService $involvedPeopleService,
                                OccurrenceObjectService $occurrenceObjectService)
    {
        $this->repository              = $repository;
        $this->involvedPeopleService   = $involvedPeopleService;
        $this->occurrenceObjectService = $occurrenceObjectService;
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
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $result = DB::transaction(function () use ($data) {
            try{
                $occurrence_report = $this->processCreate($data);

                if (isset($data['involved_people'])) {
                    foreach ($data['involved_people'] as $involved_people) {
                        $people = array_merge($involved_people, ['occurrence_report_id' => $occurrence_report['data']['id']]);
                        $person[] = $this->involvedPeopleService->create($people);
                    }
                }

                if (isset($data['occurrence_objects'])) {
                    foreach ($data['occurrence_objects'] as $occurrence_object) {
                        $report = OccurrenceReport::find($occurrence_report['data']['id']);
                        $report->objects()->attach($occurrence_object['object_id']);
                    }
                }

                if(!isset($occurrence_report)) {
                    throw new \Exception('Erro ao tentar realizar cadastro da ocorrẽncia!');
                }


                AuditLogService::write('criou boletim de ocorrência', AuditLog::LOGGABLE_TYPE_OCCURRENCE, $occurrence_report['data']['id']);

                return [
                    "data" => [
                        "error"     => "false",
                        "message"   => "Ocorrêcia registrada com sucesso."
                    ]
                ];
            } catch (\Exception $e) {
                return [
                    "data" => [
                        "error"     => "true",
                        "message"   => $e->getMessage()
                    ]
                ];
            }
        });

        return $result;
    }

    public function update(array $data, $id)
    {
        $zone = $this->processUpdate($data, $id);
        AuditLogService::write('editou boletim de ocorrência', AuditLog::LOGGABLE_TYPE_OCCURRENCE   ,  $id);

        return $zone;
    }
}
