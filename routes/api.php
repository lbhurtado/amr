<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\CommandBus\MeterDataAction;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/amr/meter/data', MeterDataAction::class)->name('meter-data');

//Route::get('/data/{from_date}/{to_date}', function (\App\Repositories\MeterDataRepository $repository, $from_date, $to_date) {
//    \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
//        \Log::info( json_encode($query->sql) );
//        \Log::info( json_encode($query->bindings) );
//        \Log::info( json_encode($query->time)   );
//    });
//
//    $data = $repository->setDates($from_date, $to_date)->get();
//
//    $grouped = $data->groupBy(['date', 'location', 'meter_id']);
//
//    return $grouped->map(function ($date_collection, $key) use (&$prev) {
//        return $date_collection->map(function ($location_collection, $key) use (&$data) {
//            return $location_collection->map(function ($meter_id_collection, $key) use (&$data) {
//                return $meter_id_collection->map(function ($collection, $key) use (&$data) {
//                    $prev = isset($data[$collection->meter_id]) ? $data[$collection->meter_id] : null;
//                    $collection->prev_wh_total = optional($prev)->wh_total;
//                    if ($collection->prev_wh_total)
//                        $collection->diff_wh_total = number_format($collection->wh_total - $collection->prev_wh_total, 2);
//                    $data[$collection->meter_id] = $collection;
//
//                    return $collection->only(['id', 'date', 'location', 'meter_id', 'wh_total', 'prev_wh_total', 'diff_wh_total']);
//                });
//            });
//        });
//    });
//});
