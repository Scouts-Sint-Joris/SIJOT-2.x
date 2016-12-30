<?php

namespace App\Http\Transformers;

use App\Activity;
use League\Fractal\TransformerAbstract;

/**
 * Class ActivityTransformer
 * @package App\Http\Transformers
 */
class ActivityTransformer extends TransformerAbstract
{
    /**
     * Output interface for the authorization api section.
     *
     * @param  Activity $activity
     * @return array
     */
    public function transform(Activity $activity)
    {
        return [
            'id'          => $activity->id,
            'title'       => $activity->heading,
            'description' => $activity->description,
            'date'        => $activity->date,
            'end_time'    => $activity->end_time,
            'start_time'  => $activity->start_time
        ];
    }
}
