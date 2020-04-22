<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository.
 */
abstract class CoreRepository
{
    abstract protected function getModelClass();

    protected $model;

    /**
     * @return string
     *  Return the model
     */

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    protected function startConditions()
    {
        return clone $this->model;
    }
}
