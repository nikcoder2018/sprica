<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
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
            'date' => $this->start_date,
            'duration' => $this->duration,
            'start' => $this->start_time,
            'end' => $this->end_time,
            'break' => $this->break,
            'project' => $this->project->title
        ];
    }
}
