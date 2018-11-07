<?php

namespace App\Presenters;

use App\Transformers\AuditLogTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AuditLogPresenter.
 *
 * @package namespace App\Presenters;
 */
class AuditLogPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AuditLogTransformer();
    }
}
