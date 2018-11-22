<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class InvolvedPersonValidator.
 *
 * @package namespace App\Validators;
 */
class InvolvedPersonValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'type'  => 'require'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
