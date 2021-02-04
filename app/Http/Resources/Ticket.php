<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ticket extends JsonResource
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
            'subject' => $this->subject,
            'requester_name' => $this->requester->name,
            'requested_on' => $this->created_at->format('d M Y'),
            'priority' => ucfirst($this->priority),
            'status' => ucfirst($this->status)
        ];
    }
}
