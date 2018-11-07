<?php

namespace App\Presenters;

use App\Transformers\IrregularityTypesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class IrregularityTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class IrregularityTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IrregularityTypesTransformer();
    }
}
