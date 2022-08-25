<?php

namespace App\Http\Controllers;

use App\DTO\DataActionsDTO\CredoBankDTO;
use App\Jobs\ExchangerRateJob;


class TestController extends Controller
{
    public $reports;

    public function __construct()
    {

    }

    public function index()
    {
        ExchangerRateJob::dispatch();
    }

}
