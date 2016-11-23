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
     * Output interface for the rental api section.
     *
     * @param Rental $rental
     * @return array
     */
    public function transform(Rental $rental)
    {
        return [
            'id' => $rental->id
        ];
    }
}
