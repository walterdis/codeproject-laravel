<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 19:01
 */

namespace CodeProject\Fractal\Presenters;

use CodeProject\Fractal\Transformers\ClientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ClientPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new ClientTransformer();
    }
} 