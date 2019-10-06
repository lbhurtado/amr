<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MeterDataRepository extends RepositoryInterface
{
    public function setDates($fromDate, $toDate);
}

