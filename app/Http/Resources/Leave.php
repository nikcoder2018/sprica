<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Leave extends JsonResource
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
            'responsive_id' => '',
            'id' => $this->id,
            'employee' => $this->user,
            'date' => $this->date,
            'status' => ucfirst($this->status),
            'type' => [
                'name' => @$this->type->name,
                'color' => @$this->type->color
            ]
        ];
    }
}
