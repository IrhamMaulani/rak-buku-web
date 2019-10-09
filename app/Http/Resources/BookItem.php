<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookItem extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
            'volume' => $this->volume,
            'description' => $this->description,
            'edition' => $this->edition,
            'print_year' => $this->print_year,
            'origin_languange' => $this->origin_languange,
            'created_at' => $this->created_at->timestamp
        ];
    }
}
