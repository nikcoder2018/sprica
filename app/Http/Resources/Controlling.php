<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\User;
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
        $logged_from = User::find($this->logged_from);
        return [
            'id' => $this->id,
            'user' => $this->user->name,
            'date' => Carbon::parse($this->start_date)->format('d.m.Y D'),
            'duration' => $this->duration,
            'project' => $this->project->title,
            'expenses' => $this->expenses->title,
            'confirmation' => $this->confirmation,
            'logged_from' => $logged_from ? $logged_from->name : '' 
        ];
    }
}
