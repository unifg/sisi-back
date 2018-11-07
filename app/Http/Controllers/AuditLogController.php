<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Traits\CrudMethods;
use App\Services\AuditLogService;
use App\Validators\LogsValidator;
/**
 * Class AuditLogController.
 *
 * @package namespace App\Http\Controllers;
 */
class AuditLogController extends Controller
{
    use CrudMethods;

    /**
     * @var LogsValidator
     */
    protected $validator;

    /** @var  */
    protected $service;

    /**
     * AuditLogController constructor.
     *
     * @param LogsValidator $validator
     * @param AuditLogService $service
     */
    public function __construct(LogsValidator $validator, AuditLogService $service)
    {
        $this->validator  = $validator;
        $this->service    = $service;
    }
}
