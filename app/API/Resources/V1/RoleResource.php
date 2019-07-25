<?php

namespace App\API\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'            => (int) $this->id,
            'name'          => (string) $this->name,
            'guard'         => (string) $this->guard_name,
            'createdAt'     => (string) $this->created_at ?? $this->created_at->toDateTimeString(),
            'updatedAt'     => (string) $this->updated_at ?? $this->updated_at->toDateTimeString(),
            'deletedAt'     => (string) $this->deleted_at ?? $this->deleted_at->toDateTimeString(),
            'permissions'   => PermissionResource::collection($this->whenLoaded('permissions'))
        ];
    }
}
