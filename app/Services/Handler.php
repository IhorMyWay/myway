<?php

namespace App\Services;

class Handler
{
    private $reports;

    public function __construct($reports)
    {
        $this->reports = $reports;
    }
}
