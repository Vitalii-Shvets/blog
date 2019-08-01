<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * Репозиторий работы с сущностью.
 * Может выдавать наборы даных.
 * Не может создавать/изменять сущности.
 */

abstract class CoreRepository extends Controller
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model\Illuminate\Contracts\Foundation\Application|Model|mixed
     */

    protected function startConditions()
    {
        return clone $this->model;
    }
}
