<?php

namespace App\Http\Resources;

use App\Http\Resources\RoleItem;
use App\Http\Resources\ReputationItem;
use Illuminate\Http\Resources\Json\JsonResource;

class UserItem extends JsonResource
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
            'id'   =>   $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'reputation' =>  new ReputationItem($this->reputation),
            'roles' => RoleItem::collection($this->roles),
            'role_name' => $this->whenPivotLoaded('role_user', function () {
                return $this->pivot->name;
            }),
        ];
    }
}
