<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Controllers\Traits\CrudMethods;
use App\Services\UserService;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    use CrudMethods {
        store as protected processStore;
    }

    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserService $service
     * @param UserValidator $validator
     */
    public function __construct(UserService $service,
                                UserValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

    /**
     * @return array|mixed
     */
    public function authenticated()
    {
        $user = $this->service->getUser(true);
        return response()->json(['data' => $user]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            $extension = $request->image->extension();
            $nameFile  = time().time().'.'.$extension;

            $upload = $request->image->storeAs('users', $nameFile);

            app()->request->merge(['url' => $nameFile]);
        }
        return $this->processStore($request);
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function mobileStore(Request $request)
    {
        app()->request->merge(['role_id' => User::COMMON_USER]);
        return $this->processStore($request);
    }
}
