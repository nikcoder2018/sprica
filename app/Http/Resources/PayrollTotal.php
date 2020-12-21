<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayrollTotal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'tax_status' => $this->tax_status,
            'hour_fee' => $this->hour_fee,
            'date_registered' => $this->dateRegistered,
            'total_hours' => 0,
            'holiday' => 0,
            'illness' => 0,
            'vacation' => 0,
            'kug' => 0, 
            'working_hours' => 0,
            'overtime' => 0,
            'night_work' => 0,
            'sunday' => 0,
            'expenses' => 0,
            'release' => 0,
            'advance' => 0,
            'travel' => 0,
            'completed' => 0
        ];
    }
}
