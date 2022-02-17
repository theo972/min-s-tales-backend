<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class EmailSendUnitTest extends TestCase {

    function pingTest(int $value) : bool {
        return $value > 0;
    }
}
