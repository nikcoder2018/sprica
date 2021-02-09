<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Notice extends JsonResource
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
            'heading' => $this->heading,
            'date' => $this->created_at->format('M d, Y')
        ];
    }
}
