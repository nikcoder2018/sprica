<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Carbon\Carbon;

class Holiday extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // {
        //     id: 2,
        //     url: '',
        //     title: 'Meeting With Client',
        //     start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
        //     end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
        //     allDay: true,
        //     extendedProps: {
        //       calendar: 'Business'
        //     }
        //   },
        return [
            'id' => $this->id,
            'url' => '',
            'title' => $this->occasion,
            'start' => $this->date,
            'end' => $this->date,
            'allDay' => true,
            'extendedProps' => [
                'calendar' => $this->occasion,
                'color' => $this->color,
            ]
        ];
    }
}
