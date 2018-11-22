<?php

namespace App\Repositories;

use App\Presenters\OccurrenceReportPresenter;
use App\Services\Traits\SoftDeletes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\OccurrenceReport;
use App\Validators\OccurrenceReportValidator;

/**
 * Class OccurrenceReportRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OccurrenceReportRepositoryEloquent extends BaseRepository implements OccurrenceReportRepository
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'zone_id',
        'occurrence_type_id',
        'status'
    ];

    /**
     * @var array
     */
    protected $fieldsRules = [
        'zone_id'               => ['numeric', 'max:2147483647'],
        'occurrence_type_id'    => ['numeric', 'max:2147483647'],
        'status'                => ['string', 20]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OccurrenceReport::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OccurrenceReportValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return OccurrenceReportPresenter::class;
    }

    /**
     * Find data by id
     *
     * @param int $id
     * @param array $columns
     * @param bool $skipPresenter
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findDeleted($id, $columns = ['*'], $skipPresenter = false)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->skipPresenter($skipPresenter)->model->withTrashed()->findOrFail($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Deleta o usuário completamente
     *
     * @param int $id
     * @return bool|null
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function forceDelete($id)
    {
        $model = $this->findDeleted($id, ['id'], true);

        $model->information()->forceDelete();

        return $model->forceDelete();
    }
}
