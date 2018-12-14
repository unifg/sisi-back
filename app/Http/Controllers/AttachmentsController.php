<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudMethods;
use App\Services\AttachmentsService;
use App\Validators\AttachmentsValidator;
use Illuminate\Http\Request;


/**
 * Class AttachmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AttachmentsController extends Controller
{

    use CrudMethods;

    /**
     * @var AttachmentsService
     */
    protected $service;

    /**
     * @var AttachmentsValidator
     */
    protected $validator;

    /**
     * AttachmentsController constructor.
     *
     * @param AttachmentsService $service
     * @param AttachmentsValidator $validator
     */
    public function __construct(AttachmentsService $service,
                                AttachmentsValidator $validator)
    {
        $this->service = $service;
        $this->validator = $validator;
    }

    public function showProfileImage($filename)
    {
        \Log::debug($filename);
        return $this->service->showProfileImage($filename);
    }
}

