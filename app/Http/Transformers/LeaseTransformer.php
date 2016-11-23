<?php

namespace App\Http\Transformers;

use App\Rental;
use League\Fractal\TransformerAbstract;

/**
 * Class LeaseTransformer
 * @package App\Http\Transformers
 */
class LeaseTransformer extends TransformerAbstract
{
    /**
     * @param Rental $book
     * @return array
     */
    public function transform(Rental $rental)
    {
        return [
            'id' => $rental->id
        ];
    }
}