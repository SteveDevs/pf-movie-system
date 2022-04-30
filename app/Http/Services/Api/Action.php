<?php

namespace App\Http\Services\Api;

abstract class Action
{
    protected HandleReturn $handleReturn;

    protected bool $success = false;
    protected array $messages = [];
    protected int $code;

    public function __construct()
    {
        $this->handleReturn = new HandleReturn();
    }

    abstract public function handle() : HandleReturn;
    abstract protected function checkError() : void;
}
