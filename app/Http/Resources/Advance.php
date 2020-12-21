<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Advance extends JsonResource
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
            'received_at' => $this->received_at,
            'debit_at' => $this->debit_at,
            'amount' => $this->amount,
            'employee' => $this->user->name,
            'paid_by' => $this->paid_by
        ];
    }
}
