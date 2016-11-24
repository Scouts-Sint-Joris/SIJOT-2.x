<?php

namespace App\Repositories\Criteria\Eloquent;

use App\Repositories\Criteria\Criteria;
use App\Repositories\Contracts\RepositoryInterface as Repository;

/**
 * Class StatusRelation
 * @package App\Repositories\Criteria\Lease
 */
class Relation
{
    /**
     * Eloquent relation definition.
     * This can be a string or array.
     *
     * @var $relation.
     */
    private $relation;

    /**
     * LengthOverTwoHours constructor.
     * @param $relation
     */
    public function __construct($relation)
    {
        $this->relation = $relation;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->with($this->relation);
        return $model;
    }
}