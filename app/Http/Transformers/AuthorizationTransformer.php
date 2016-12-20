<?php

namespace App\Http\Transformers;

use Chrisbjr\ApiGuard\Models\ApiKey;
use League\Fractal\TransformerAbstract;

/**
 * Class AuthorizationTransformer
 * @package App\Http\Transformers
 */
class AuthorizationTransformer extends TransformerAbstract
{
    /**
     * Output interface for the authorization api section.
     *
     * @param  ApiKey $info
     * @return array
     */
    public function transform(ApiKey $info)
    {
        return [
            'id'            => $info->id,
            'user_id'       => $info->user_id,
            'service'       => $info->service,
            'key'           => $info->key,
            'level'         => $info->level,
            'ignore_limit'  => $info->ignore_limits,
            'timestamps'    => [
                'created' => $info->created_at,
                'updated' => $info->updated_at,
                'deleted' => $info->deleted_at,
            ]
        ];
    }
}