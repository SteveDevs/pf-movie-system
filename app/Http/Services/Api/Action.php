<?php

namespace App\Http\Services\Api;

abstract class Action
{
    /**
     * @var HandleReturn
     */
    protected HandleReturn $handleReturn;

    /**
     * @var bool
     */
    protected bool $success = false;

    /**
     * @var array
     */
    protected array $messages = [];

    /**
     * @var int
     */
    protected int $code;

    public function __construct()
    {
        $this->handleReturn = new HandleReturn();
    }

    /**
     * Handle action for api service function
     * @return HandleReturn
     */
    abstract public function handle() : HandleReturn;

    /**
     * Check errors on api service call
     * @return void
     */
    abstract public function checkError() : void;
}
