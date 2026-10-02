<?php

namespace App\Services;

class QrTokenService
{
    public function generate(): string
    {
        return bin2hex(random_bytes(32));
    }
}
