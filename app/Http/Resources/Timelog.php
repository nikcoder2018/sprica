<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Timelog extends JsonResource
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
            'date' => $this->start_date->format('M d, Y'),
            'begin' => $this->start_date->format('h:i A'),
            'end' => date('h:i A',strtotime($this->end_time)),
            'duration' => $this->duration,
            'project' => $this->project->title
        ];
    }
}
