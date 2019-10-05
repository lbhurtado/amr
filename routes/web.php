<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/amr/data/{from_date}/{to_date}', function (Request $request, $from_date, $to_date) {

    $location = $request->query('location');
    $meter_id = $request->query('meter_id');
    $data = \App\MeterData::from($from_date)->to($to_date)->inLocation($location)->usingMeterId($meter_id)->orderBy('datetime', 'asc')->get();

    $filtered = $data->filter(function ($value, $key) {
        return true;
    });
    $grouped = $filtered->groupBy(['date', 'location', 'meter_id']);

    return $grouped->map(function ($date_collection, $key) use (&$prev) {
        return $date_collection->map(function ($location_collection, $key) use (&$data) {
            return $location_collection->map(function ($meter_id_collection, $key) use (&$data) {
                return $meter_id_collection->map(function ($collection, $key) use (&$data) {
                    $prev = isset($data[$collection->meter_id]) ? $data[$collection->meter_id] : null;
                    $collection->prev_wh_total = optional($prev)->wh_total;
                    if ($collection->prev_wh_total)
                        $collection->diff_wh_total = number_format($collection->wh_total - $collection->prev_wh_total, 2);
                    $data[$collection->meter_id] = $collection;

                    return $collection->only(['id', 'date', 'location', 'meter_id', 'wh_total', 'prev_wh_total', 'diff_wh_total']);
                });
            });
        });
    });
});
