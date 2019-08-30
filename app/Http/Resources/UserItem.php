<?php

namespace App\Http\Resources;

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
            'reputation' => $this->reputation,
            'is_author' => $this->isAuthor($this->is_author),
            'roles' => RoleItem::collection($this->roles),
            'role_name' => $this->whenPivotLoaded('role_user', function () {
                return $this->pivot->name;
            }),
        ];
    }
}
