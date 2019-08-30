<?php

namespace App\Http\Resources;

use App\Http\Resources\RoleItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => RoleItem::collection($this->collection)
        ];
    }
}
