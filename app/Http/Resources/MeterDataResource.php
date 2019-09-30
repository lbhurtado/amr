<?php

namespace App\Http\Resources;

use App\Facades\AMR;
use Illuminate\Http\Resources\Json\JsonResource;

class MeterDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return AMR::getMeterData()->toArray();
    }
}
