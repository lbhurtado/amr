<?php

namespace App\Repositories;

use App\MeterData;
use App\Validators\MeterDataValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


class MeterDataRepositoryEloquent extends BaseRepository implements MeterDataRepository
{
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
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
