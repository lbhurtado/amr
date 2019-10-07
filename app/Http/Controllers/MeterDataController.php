<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Repositories\MeterDataRepository;
use Illuminate\Support\Collection;

class MeterDataController extends Controller
{
    /** @var MeterDataRepository */
    protected $repository;

    /**
     * MeterDataController constructor.
     *
     * @param MeterDataRepository $repository
     */
    public function __construct(MeterDataRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the incoming request.
     *
     * @param $from_date
     * @param $to_date
     * @return mixed
     */
    public function __invoke($from_date, $to_date)
    {
        $collection = $this->repository->setDates($from_date, $to_date)->orderBy('datetime', 'asc')->get();

        $group_collection = $collection->groupBy(['date', 'location', 'meter_id']);

//        return $group_collection;

        return $group_collection->map(function ($date_collection, $key) use (&$prev, &$placeholder) {
            return $date_collection->map(function ($location_collection, $key) use (&$placeholder) {
                return $location_collection->map(function ($meter_id_collection, $key) use (&$placeholder) {
//                    $prev = isset($placeholder[$key]) ? $placeholder[$key] : null;
//                    dd($prev);
                    return $meter_id_collection->map(function ($collection, $key) use (&$placeholder) {

                        $prev = isset($placeholder[$collection->meter_id]) ? $placeholder[$collection->meter_id] : null;
                        $collection->hour_of_day = Carbon::parse($collection->datetime)->format('H');
                        $collection->prev_wh_total = optional($prev)->wh_total ?? $collection->wh_total;
                        if ($collection->prev_wh_total) {
                            $collection->diff_wh_total = number_format($collection->wh_total - $collection->prev_wh_total, 2);
                        }
                        $placeholder[$collection->meter_id] = $collection;

                        return $collection->only(['id', 'date', 'location', 'meter_id', 'hour_of_day', 'wh_total', 'prev_wh_total', 'diff_wh_total']);
                    });
                });
            });
        });
    }
//
//    protected function collection_map_recursive($callback, $collection)
//    {
//        $func = function($item) use (&$func, &$callback) {
//
//            return ($item instanceof Collection) ? $item->map($func) : call_user_func($callback, $item);
//        };
//
//        return $collection->map($func);
//    }
}
