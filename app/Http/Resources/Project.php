<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $completed = count($this->tasks_completed);
        $tasks = count($this->tasks);
        if($tasks > 0) $progress = ($completed/$tasks)*100; else  $progress = 0;

        return [
            'responsive_id' => '',
            'id' => $this->id,
            'title' => $this->title,
            'client' => $this->client->name,
            'leader' => $this->leader,
            'members' => $this->members,
            'progress' => $progress,
            'hours' => $this->hours,
            'status' => $this->status
        ];
    }
}
