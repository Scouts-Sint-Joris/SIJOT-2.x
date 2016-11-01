<?php


namespace App\Http\Controllers\Api;

use Brotzka\DotenvEditor\DotenvEditor;
use Chrisbjr\ApiGuard\Http\Controllers\ApiGuardController;

/**
 * Class EnvController
 * @package App\Http\Controllers\Api
 */
class EnvController extends ApiGuardController
{
    /**
     * @var DotenvEditor
     */
    private $env;

    /**
     * EnvController constructor.
     *
     * @param DotenvEditor $env
     */
    public function __construct(DotenvEditor $env)
    {
        $this->env = $env;
    }

    public function getValues()
    {
        $data = $this->env->getContent();
        $content = $this->response->withArray($data);

        return response($content, 200)->header('Content-Type', 'Application/json');
    }
}