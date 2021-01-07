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
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'end_date' => $this->end_date,
            'end_time' => $this->end_time,
            'duration' => $this->duration,
            'break' => $this->break,
            'project' => $this->project->title
        ];
    }
}
