<?php

namespace App\Repositories;

/**
 * Class SessionRepository
 * @package App\Repositories\Repository
 */
class SessionRepository
{
    /**
     * Set a flash message.
     *
     * @param string $class
     * @param string $message
     */
    public function setFlash($class = '', $message = '')
    {
        session()->flash('message', $message);
        session()->flash('class', $class);
    }
}