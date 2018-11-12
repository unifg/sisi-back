<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' 		 	 => 'required|max:250',
            'cpf'            => 'required|max:14|unique:users,cpf',
            'birthdate'      => 'required|date',
            'gender'         => 'required|in:MASCULINO,FEMININO,TRANS_MASC,TRANS_FEM,NAO_DECLARADO',
            'skin_color'     => 'required|in:BRANCO,PARDO,NEGRO,INDIGENA,AMARELO,NAO_DECLARADO',
            'cellphone'      => 'required|string|unique:users,cellphone',
            'phone'          => 'sometimes|string|nullable',
            'email'    		 => 'required|email|max:150|unique:users,email',
            'password'       => 'required|max:32|string',
            'status'  	 	 => 'required|in:ATIVO,BLOQUEADO,INATIVO',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' 		 	 => 'sometimes|max:250',
            'birthdate'      => 'sometimes|date',
            'gender'         => 'sometimes|in:MASCULINO,FEMININO,TRANS_MASC,TRANS_FEM,NAO_DECLARADO',
            'skin_color'     => 'sometimes|in:BRANCO,PARDO,NEGRO,INDIGENA,AMARELO,NAO_DECLARADO',
            'cellphone'      => 'sometimes|string',
            'phone'          => 'sometimes|string|nullable',
            'password'       => 'sometimes|max:32|string',
            'status'  	 	 => 'sometimes|in:ATIVO,BLOQUEADO,INATIVO',
        ],
    ];

    /**
     * Set data to validate
     *
     * @param array $data
     * @return $this
     */
    public function with(array $data)
    {
        if(!empty($data['id'])){
            $this->rules[ValidatorInterface::RULE_UPDATE]['email'] = "email|max:150|unique:users,email,".$data['id'];
        }

        if(!empty($data['id'])){
            $this->rules[ValidatorInterface::RULE_UPDATE]['cpf'] = "required|max:14|unique:users,cpf,".$data['id'];
        }

        if(!empty($data['id'])){
            $this->rules[ValidatorInterface::RULE_UPDATE]['cellphone'] = "string|unique:users,cellphone,".$data['id'];
        }

        $this->data = $data;

        return $this;
    }
}
