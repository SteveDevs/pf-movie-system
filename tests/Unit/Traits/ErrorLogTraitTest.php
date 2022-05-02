<?php

namespace Tests\Unit\Traits;

use App\Traits\ErrorLogTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ErrorLogTraitTest extends TestCase
{
    use ErrorLogTrait, DatabaseTransactions;

    public function testUpdateErrorDBLog()
    {
        $id = $this->updateErrorDBLog('Test message');

        $this->assertDatabaseHas('error_logs', [
            'id' => $id, 'message' => 'Test message'
        ]);
    }

}
