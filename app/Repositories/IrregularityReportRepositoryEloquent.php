<?php

namespace App\Repositories;

use App\Presenters\IrregularityReportPresenter;
use App\Services\Traits\SoftDeletes;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IrregularityReportRepository;
use App\Entities\IrregularityReport;
use App\Validators\IrregularityReportValidator;

/**
 * Class IrregularityReportRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IrregularityReportRepositoryEloquent extends BaseRepository implements IrregularityReportRepository
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
        'irregularity_type_id'    => ['numeric', 'max:2147483647'],
        'status'                => ['string', 20]
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IrregularityReport::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IrregularityReportValidator::class;
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
        return IrregularityReportPresenter::class;
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
