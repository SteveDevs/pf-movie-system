<?php

namespace App\Traits;

use App\Models\ErrorLog;

trait ErrorLogTrait {

    /**
     * @param string $message
     * @param int $type
     * @return int
     */
    public function updateErrorDBLog(string $message) : int
    {
        $log = new ErrorLog();
        $log->message = $message;

        $log->save();

        return $log->id;
    }

}
