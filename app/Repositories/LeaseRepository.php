<?php

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

/**
 * Class LeaseRepository
 * @package App\Repositories\Repository
 */
class LeaseRepository extends Repository
{
    /**
     * Set the database model
     *
     * @return mixed
     */
    public function model()
    {
       return'App\Rental';
    }
}