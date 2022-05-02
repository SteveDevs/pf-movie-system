<?php

namespace App\Http\Services\Api;

class HandleReturn
{
    /**
     * @var bool
     */
    public bool $success;

    /**
     * Error/Success messages
     * @var array
     */
    public array $messages;
}
