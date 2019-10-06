<?php

namespace App\Repositories;

use App\MeterData;
use App\Validators\MeterDataValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


class MeterDataRepositoryEloquent extends BaseRepository implements MeterDataRepository
{
    protected $fieldSearchable = [
        'datetime',
        'location',
        'meter_id',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MeterData::class;
    }

//    /**
//     * Specify Validator class name
//     *
//     * @return mixed
//     */
//    public function validator()
//    {
//
//        return MeterDataValidator::class;
//    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class))->orderBy('datetime', 'asc');
    }

    public function setDates($fromDate, $toDate)
    {
        return $this->scopeQuery(function($query) use ($fromDate, $toDate) {
            return $query->whereBetween('datetime', [$fromDate, $toDate]);
        });
    }
}
