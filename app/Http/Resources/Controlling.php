<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class Controlling extends JsonResource
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
            'date' => Carbon::parse($this->start_date)->format('d.m.Y D'),
            'duration' => $this->duration,
            'project' => $this->project->title,
            'expenses' => $this->expenses->title,
            'confirmation' => $this->confirmation
        ];
    }
}
