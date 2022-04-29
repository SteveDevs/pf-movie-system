<?php

namespace App\Traits;

use App\Models\ErrorLog;

trait ErrorLogTrait {

    private $sendNotificationsTo;

    public function __construct()
    {
        $this->sendNotificationsTo = 'admin@email.com';
    }

    /**
     * @param string $message
     * @param int $type
     * @return void
     */
    public function updateErrorDBLog(string $message, int $type)
    {
        $log = new ErrorLog();
        $log->message = $message;

        $log->save();
    }

}
