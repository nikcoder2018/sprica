<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payroll extends JsonResource
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
            'date' => $this->start_date->format('d.m.Y D'),
            'time' => $this->start_date->format('H:s a'),
            'project' => $this->project->title,
            'from' => $this->start_date->format('H:s a'),
            'to' => $this->end_date->format('H:s a'),
            'expenses1' => $this->expenses->expenses_1,
            'expenses2' => $this->expenses->expenses_2,
            'overnight' => $this->expenses->overnight
        ];
    }
}
